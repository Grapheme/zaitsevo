<?php

class AdminCatalogCategoriesController extends BaseController {

    public static $name = 'category';
    public static $group = 'catalog';
    public static $entity = 'category';
    public static $entity_name = 'категория';

    /****************************************************************************/

    ## Routing rules of module
    public static function returnRoutes($prefix = null) {
        $class = __CLASS__;
        $entity = self::$entity;

        Route::group(array('before' => 'auth', 'prefix' => $prefix . "/" . $class::$group), function() use ($class, $entity) {

            Route::post($class::$name.'/ajax-nested-set-model', array('as' => $class::$group . '.' . $class::$name . '.nestedsetmodel', 'uses' => $class."@postAjaxNestedSetModel"));

            Route::resource($class::$name, $class,
                array(
                    'except' => array('show'),
                    'names' => array(
                        'index'   => $class::$group . '.' . $class::$name . '.index',
                        'create'  => $class::$group . '.' . $class::$name . '.create',
                        'store'   => $class::$group . '.' . $class::$name . '.store',
                        'edit'    => $class::$group . '.' . $class::$name . '.edit',
                        'update'  => $class::$group . '.' . $class::$name . '.update',
                        'destroy' => $class::$group . '.' . $class::$name . '.destroy',
                    )
                )
            );
        });
    }

    ## Shortcodes of module
    public static function returnShortCodes() {
        ##
    }
    
    ## Actions of module (for distribution rights of users)
    public static function returnActions() {
        ##return array();
    }

    ## Info about module (now only for admin dashboard & menu)
    public static function returnInfo() {
        ##
    }
        
    /****************************************************************************/
    
	public function __construct() {

        $this->module = array(
            'name' => self::$name,
            'group' => self::$group,
            'rest' => self::$group,
            'tpl' => static::returnTpl('admin/' . self::$name),
            'gtpl' => static::returnTpl(),

            'entity' => self::$entity,
            'entity_name' => self::$entity_name,

            'class' => __CLASS__,
        );

        View::share('module', $this->module);
	}

	public function index() {

        Allow::permission($this->module['group'], 'categories_view');

        $elements = new CatalogCategory();
        $tbl_cat_category = $elements->getTable();

        /**
         * Подготавливаем запрос для выборки
         */
        $elements = $elements
            ->orderBy(DB::raw('-' . $tbl_cat_category . '.lft'), 'DESC') ## 0, 1, 2 ... NULL, NULL
            ->orderBy($tbl_cat_category . '.created_at', 'ASC')
            ->orderBy($tbl_cat_category . '.id', 'DESC')
            ->with('meta', 'products', 'attributes_groups.attributes')
        ;

        /**
         * Если задана корневая категория - выбираем только ее содержимое
         */
        $root_category = null;
        if (NULL !== ($root_id = Input::get('root'))) {
            $root_category = CatalogCategory::find($root_id);
            $root_category->load('meta')->extract(1);
            #Helper::tad($root_category);
            if (is_object($root_category)) {
                $elements = $elements
                    ->where('lft', '>', $root_category->lft)
                    ->where('rgt', '<', $root_category->rgt)
                    ;
            }
        }

        /**
         * Получаем все категории из БД
         */
        $elements = $elements->get();
        $elements = DicVal::extracts($elements, 1);
        $elements = Dic::modifyKeys($elements, 'id');

        /**
         * Строим иерархию
         */
        $id_left_right = array();
        foreach($elements as $element) {
            $id_left_right[$element->id] = array();
            $id_left_right[$element->id]['left'] = $element->lft;
            $id_left_right[$element->id]['right'] = $element->rgt;
        }
        $hierarchy = (new NestedSetModel())->get_hierarchy_from_id_left_right($id_left_right);


        if ( 0 ) {
            Helper::ta($elements);
            Helper::tad($hierarchy);
        }

        $sortable = 9;

        return View::make($this->module['tpl'].'index', compact('elements', 'hierarchy', 'sortable', 'root_category'));
	}

    /************************************************************************************/

	public function create() {

        Allow::permission($this->module['group'], 'categories_create');

        $element = new CatalogCategory();

        $locales = Config::get('app.locales');

		return View::make($this->module['tpl'].'edit', compact('element', 'locales'));
	}
    

	public function edit($id) {

        Allow::permission($this->module['group'], 'categories_edit');

		$element = CatalogCategory::where('id', $id)
            ->with('seos', 'metas', 'meta')
            ->first()
            ->extract();

        if (is_object($element) && is_object($element->meta))
            $element->name = $element->meta->name;

        $locales = Config::get('app.locales');

        #Helper::tad($element);

        return View::make($this->module['tpl'].'edit', compact('element', 'locales'));
	}


    /************************************************************************************/


	public function store() {

        Allow::permission($this->module['group'], 'categories_create');
		return $this->postSave();
	}


	public function update($id) {

        Allow::permission($this->module['group'], 'categories_edit');
		return $this->postSave($id);
	}


	public function postSave($id = false){

        if (@$id)
            Allow::permission($this->module['group'], 'categories_edit');
        else
            Allow::permission($this->module['group'], 'categories_create');

		if(!Request::ajax())
            App::abort(404);

        if (!$id || NULL === ($element = CatalogCategory::find($id)))
            $element = new CatalogCategory();

        $input = Input::all();

        /**
         * Проверяем системное имя
         */
        if (!trim($input['slug'])) {
            $input['slug'] = $input['meta'][Config::get('app.locale')]['name'];
        }
        $input['slug'] = Helper::translit($input['slug']);

        $slug = $input['slug'];
        $exit = false;
        $i = 1;
        do {
            $test = CatalogCategory::where('slug', $slug)->first();
            #Helper::dd($count);

            if (!is_object($test) || $test->id == $element->id) {
                $input['slug'] = $slug;
                $exit = true;
            } else
                $slug = $input['slug'] . (++$i);

            if ($i >= 10 && !$exit) {
                $input['slug'] = $input['slug'] . '_' . md5(rand(999999, 9999999) . '-' . time());
                $exit = true;
            }

        } while (!$exit);

        /**
         * Проверяем флаг активности
         */
        $input['active'] = @$input['active'] ? 1 : NULL;

        #Helper::dd($input);

        $json_request['responseText'] = "<pre>" . print_r($_POST, 1) . "</pre>";
        #return Response::json($json_request,200);

        $json_request = array('status' => FALSE, 'responseText' => '', 'responseErrorText' => '', 'redirect' => FALSE);
		$validator = Validator::make($input, array('slug' => 'required'));
		if($validator->passes()) {

            #$redirect = false;

            if ($element->id > 0) {

                $element->update($input);
                $redirect = false;
                $category_id = $element->id;

                /**
                 * Обновим slug на форме
                 */
                if (Input::get('slug') != $input['slug']) {
                    $json_request['form_values'] = array('input[name=slug]' => $input['slug']);
                }

            } else {

                /**
                 * Ставим элемент в конец списка
                 */
                $max_rgt = CatalogCategory::max('rgt');
                $input['lft'] = @(int)$max_rgt+1;
                $input['rgt'] = @(int)$max_rgt+2;

                $element->save();
                $element->update($input);
                $category_id = $element->id;
                $redirect = Input::get('redirect');

                /**
                 * Создаем группу атрибутов по умолчанию
                 */
                $max_rgt = CatalogAttributeGroup::where('category_id', $category_id)->max('rgt');
                $group = CatalogAttributeGroup::create(array(
                    'id' => null,
                    'category_id' => $category_id,
                    'active' => 1,
                    'slug' => 'default',
                    'lft' => @(int)$max_rgt+1,
                    'rgt' => @(int)$max_rgt+2,
                ));
                CatalogAttributeGroupMeta::create(array(
                    'id' => null,
                    'attributes_group_id' => $group->id,
                    'language' => 'ru',
                    'active' => 1,
                    'name' => 'По умолчанию',
                ));
            }


            /**
             * Сохраняем META-данные
             */
            if (
                isset($input['meta']) && is_array($input['meta']) && count($input['meta'])
            ) {
                foreach ($input['meta'] as $locale_sign => $meta_array) {
                    $meta_search_array = array(
                        'category_id' => $category_id,
                        'language' => $locale_sign
                    );
                    $meta_array['active'] = @$meta_array['active'] ? 1 : NULL;
                    $category_meta = CatalogCategoryMeta::firstOrNew($meta_search_array);
                    if (!$category_meta->id)
                        $category_meta->save();
                    $category_meta->update($meta_array);
                    unset($category_meta);
                }
            }

            /**
             * Сохраняем SEO-данные
             */
            if (
                Allow::module('seo')
                && Allow::action('seo', 'edit')
                && Allow::action($this->module['group'], 'categories_seo')
                && isset($input['seo']) && is_array($input['seo']) && count($input['seo'])
            ) {
                foreach ($input['seo'] as $locale_sign => $seo_array) {
                    ## SEO
                    if (is_array($seo_array) && count($seo_array)) {
                        ###############################
                        ## Process SEO
                        ###############################
                        ExtForm::process('seo', array(
                            'module'  => 'CatalogCategory',
                            'unit_id' => $element->id,
                            'data'    => $seo_array,
                            'locale'  => $locale_sign,
                        ));
                        ###############################
                    }
                }
            }

            $json_request['responseText'] = 'Сохранено';
            if ($redirect)
			    $json_request['redirect'] = $redirect;
			$json_request['status'] = TRUE;

		} else {

			$json_request['responseText'] = 'Неверно заполнены поля';
			$json_request['responseErrorText'] = $validator->messages()->all();
		}
		return Response::json($json_request, 200);
	}

    /************************************************************************************/

	public function destroy($id){

        Allow::permission($this->module['group'], 'categories_delete');

		if(!Request::ajax())
            App::abort(404);

		$json_request = array('status' => FALSE, 'responseText' => '');

        $element = CatalogCategory::where('id', $id)->with('attributes_groups.attributes')->first();

        #Helper::tad($element);

        if (is_object($element)) {
            /**
             * Удаление:
             * !! товаров категории,
             * - связок с атрибутами/группами,
             * + SEO-данных,
             * + мета-данных
             * + и самой категории
             */


            /*
            $groups = $element->attributes_groups;
            $attributes = $groups->attributes();
            $groups->delete();
            $attributes->delete();
            */

            if (isset($element->attributes_groups) && is_object($element->attributes_groups) && count($element->attributes_groups)) {

                $groups_ids = array();
                $attributes_ids = array();
                foreach ($element->attributes_groups as $group) {

                    $groups_ids[] = $group->id;

                    if (isset($group->attributes) && is_object($group->attributes) && count($group->attributes)) {
                        foreach ($group->attributes as $attribute) {
                            $attributes_ids[] = $attribute->id;
                        }
                    }
                }

                #Helper::d($groups_ids);
                #Helper::dd($attributes_ids);

                if (count($attributes_ids)) {
                    CatalogAttributeMeta::whereIn('attribute_id', $attributes_ids)->delete();
                    CatalogAttribute::whereIn('id', $attributes_ids)->delete();
                }
                if (count($groups_ids)) {
                    CatalogAttributeGroupMeta::whereIn('attributes_group_id', $groups_ids)->delete();
                    CatalogAttributeGroup::whereIn('id', $groups_ids)->delete();
                }
            }


            if (Allow::module('seo')) {
                Seo::where('module', 'CatalogCategory')
                    ->where('unit_id', $element->id)
                    ->delete()
                ;
            }

            $element->metas()->delete();

            $element->delete();

            /**
             * Сдвигаем категории в общем дереве
             */
            if ($element->rgt)
                DB::update(DB::raw("UPDATE " . $element->getTable() . " SET lft = lft - 2, rgt = rgt - 2 WHERE lft > " . $element->rgt . ""));

            $json_request['responseText'] = 'Удалено';
            $json_request['status'] = TRUE;
        }

		return Response::json($json_request,200);
	}

    public function postAjaxNestedSetModel() {

        #$input = Input::all();

        $data = Input::get('data');
        $data = json_decode($data, 1);
        #Helper::dd($data);

        $offset = 0;
        $root_id = (int)Input::get('root');
        if ($root_id > 0) {
            $root_category = CatalogCategory::find($root_id);
            if (is_object($root_category)) {
                $offset = $root_category->lft;
            }
        }

        if (count($data)) {

            $id_left_right = (new NestedSetModel())->get_id_left_right($data);

            if (count($id_left_right)) {

                $cats = CatalogCategory::whereIn('id', array_keys($id_left_right))->get();

                if (count($cats)) {
                    foreach ($cats as $cat) {
                        $cat->lft = $id_left_right[$cat->id]['left'] + $offset;
                        $cat->rgt = $id_left_right[$cat->id]['right'] + $offset;
                        $cat->save();
                    }
                }
            }
        }

        return Response::make('1');
    }

    public function getImport($dic_id){

        Allow::permission($this->module['group'], 'import');

        $dic = Dictionary::where(is_numeric($dic_id) ? 'id' : 'slug', $dic_id)->first();
        if (!is_object($dic))
            App::abort(404);

        #Helper::dd($dic);

        $element = $dic;

        return View::make($this->module['tpl'].'import', compact('dic', 'dic_id', 'element'));
    }

    public function postImport2($dic_id){

        Allow::permission($this->module['group'], 'import');

        $dic = Dictionary::where(is_numeric($dic_id) ? 'id' : 'slug', $dic_id)->first();
        if (!is_object($dic))
            App::abort(404);
        #Helper::tad($dic);

        #Helper::dd( Input::all() );

        $input = Input::all();
        $lines = explode("\n", $input['import_data']);
        $array = array();
        $max = 0;
        foreach ($lines as $line) {
            if (@$input['trim'])
                $line = trim($line, $input['trim_params'] . ' ' ?: ' ');
            if (@$input['delimeter'])
                $line = explode($input['delimeter'], $line);
            else
                $line = array($line);

            if (count($line) > $max)
                $max = count($line);

            if ($line)
                $array[] = $line;
        }

        #Helper::dd($array);

        $fields = array('Выберите...', 'name' => 'Название', 'slug' => 'Системное имя') + array_keys((array)Config::get('dic/' . $dic->slug . '.fields'));
        #Helper::dd($fields);

        $element = $dic;

        return View::make($this->module['tpl'].'import2', compact('dic', 'dic_id', 'element', 'array', 'max', 'fields'));
    }

    public function postImport3($dic_id){

        Allow::permission($this->module['group'], 'import');

        $dic = Dictionary::where(is_numeric($dic_id) ? 'id' : 'slug', $dic_id)
            #->with('values')
            ->first();

        if (!is_object($dic))
            App::abort(404);
        #Helper::tad($dic);

        ## Get also exists values
        #$exist_values = $dic->values;
        #Helper::ta($exist_values);

        $input = Input::all();

        /*
        foreach ($exist_values as $e => $exist_value) {
            if ($input['rewrite_mode'] == 1)
                $exist_values[$exist_value->name] = $exist_value;
            else
                $exist_values[$exist_value->slug] = $exist_value;
            unset($exist_values[$e]);
        }
        Helper::ta($exist_values);
        */

        $max = count($input['values'][0]);

        $fields = $input['fields'];
        $values = $input['values'];

        ## Filter fields & values
        foreach ($fields as $f => $field) {
            if (is_numeric($field) && $field == 0) {
                #Helper::d($f . " => " . $field . " = 0");
                unset($fields[$f]);
                unset($values[$f]);
            }
        }

        #Helper::d($fields);
        #Helper::d($values);

        ## Make insertions
        $find_key = ($input['rewrite_mode'] == 1) ? 'name' : 'slug';
        $array = array();
        $count = count($values[0]);
        for ($i = 0; $i < $count; $i++) {
            $arr = array(
                'dic_id' => $dic->id,
            );
            foreach ($fields as $f => $field) {
                $arr[$field] = @trim($values[$f][$i]);
            }

            $find = array($find_key => @$arr[$find_key], 'dic_id' => $dic->id);
            #unset($arr[$find_key]);
            if (
                #$find_key != 'slug'
                @$input['set_slug']
                && (
                    $input['set_slug_elements'] == 'all'
                    || ($input['set_slug_elements'] == 'empty' && !@$arr['slug'])
                )
            ) {
                $arr['slug'] = Helper::translit(@$arr['name']);
            }

            if (@$input['set_ucfirst'] && $arr['name']) {
                $arr['name'] = Helper::mb_ucfirst($arr['name']);
            }

            #Helper::dd($find);

            #/*
            $dicval = DicVal::firstOrCreate($find);
            $dicval->update($arr);
            #Helper::ta($dicval);
            #*/

            unset($dicval);
            #$array[] = $arr;
        }

        #Helper::d($array);

        return Redirect::route('dicval.index', $dic_id);
    }

    public function getSphinx($dic_id) {

        if (!Allow::superuser())
            App::abort(404);

        $dic = Dictionary::where(is_numeric($dic_id) ? 'id' : 'slug', $dic_id)
            #->with('values')
            ->first();

        if (!is_object($dic))
            App::abort(404);

        #Helper::d('Данные словаря:') . Helper::ta($dic);

        $fields = Config::get('dic/' . $dic->slug . '.fields');
        if (isset($fields) && is_callable($fields))
            $fields = $fields();

        #Helper::d('Доп. поля словаря (fields):') . Helper::d($fields);

        $fields_i18n = Config::get('dic/' . $dic->slug . '.fields_i18n');
        if (isset($fields_i18n) && is_callable($fields_i18n))
            $fields_i18n = $fields_i18n();

        #Helper::d('Мультиязычные доп. поля словаря (fields_i18n):') . Helper::d($fields_i18n);

        $tbl_dic_field_val = (new DicFieldVal)->getTable();
        $tbl_dic_textfield_val = (new DicTextFieldVal)->getTable();

        /**
         * Будут индексироваться только поля следующих типов
         */
        $indexed_types = array('textarea', 'textarea_redactor', 'text');
        $fulltext_types = array('textarea', 'textarea_redactor');

        $selects = array(
            "dicval.id AS id",
            $dic->id . " AS dic_id",
            "'" . $dic->name . "' AS dic_name",
            "'" . $dic->slug . "' AS dic_slug",
            "dicval.name AS name"
        );
        $sql = array();

        $j = 0;
        /**
         * Поиск по обычным полям
         */
        if (isset($fields) && is_array($fields) && count($fields)) {
            foreach ($fields as $field_key => $field) {

                if (!isset($field['type']) || !in_array($field['type'], $indexed_types))
                    continue;

                $tbl_field = in_array($field['type'], $fulltext_types) ? $tbl_dic_textfield_val : $tbl_dic_field_val;

                ++$j;
                $tbl =  "tbl" . $j;
                ##$selects[] = $tbl . '.language AS language';
                $selects[] = $tbl . '.value AS ' . $field_key;
                $sql[] = "LEFT JOIN " . $tbl_field . " AS " . $tbl . " ON " . $tbl . ".dicval_id = dicval.id AND " . $tbl . ".key = '" . $field_key . "' AND " . $tbl . ".language IS NULL";
            }
        }
        /**
         * Поиск по мультиязычным полям
         */
        if (isset($fields_i18n) && is_array($fields_i18n) && count($fields_i18n)) {
            foreach ($fields_i18n as $field_key => $field) {

                if (!in_array($field['type'], $indexed_types))
                    continue;

                $tbl_field = in_array($field['type'], $fulltext_types) ? $tbl_dic_textfield_val : $tbl_dic_field_val;

                ++$j;
                $tbl =  "tbl" . $j;
                ##$selects[] = $tbl . '.language AS language';
                $selects[] = $tbl . '.value AS ' . $field_key;
                $sql[] = "LEFT JOIN " . $tbl_field . " AS " . $tbl . " ON " . $tbl . ".dicval_id = dicval.id AND " . $tbl . ".key = '" . $field_key . "' AND " . $tbl . ".language IS NOT NULL";
            }
        }

        $sql[] = "WHERE dicval.version_of IS NULL AND dicval.dic_id = '" . $dic->id . "'";

        $selects_compile = implode(', ', $selects);

        array_unshift($sql, "SELECT " . $selects_compile . " FROM " . (new DicVal)->getTable() . " AS dicval");

        return
            "<h1>Поиск по словарю &laquo;" . $dic->name . "&raquo; (" . $dic->slug . ")</h1>" .
            "<h3>SQL-запрос для тестирования (phpMyAdmin):</h3>" .
            nl2br(implode("\n", $sql)) .
            "<h3>SQL-запрос для вставки в конфиг Sphinx:</h3>" .
            "<pre>
    sql_query     = \\\n        " . (implode(' \\'."\n        ", $sql)) . "

    sql_attr_uint = id
</pre>"
            ;
    }

}


