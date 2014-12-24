<?php

class ApplicationController extends BaseController {

    public static $name = 'application';
    public static $group = 'application';

    /****************************************************************************/

    ## Routing rules of module
    public static function returnRoutes($prefix = null) {

        Route::group(array(), function() {

            Route::any('/ajax/request-call', array('as' => 'ajax.request-call', 'uses' => __CLASS__.'@postRequestCall'));
            Route::any('/ajax/send-message', array('as' => 'ajax.send-message', 'uses' => __CLASS__.'@postSendMessage'));
            Route::any('/ajax/architects-competition', array('as' => 'ajax.architects-competition', 'uses' => __CLASS__.'@postArchitectsCompetition'));
        });
    }


    /****************************************************************************/


	public function __construct(){
        #
	}


    public function postRequestCall() {

        $json_request = array('status' => FALSE, 'responseText' => '');

        /**
         * Более-менее стандартный функционал для отправки сообщения на e-mail
         */
        $data = Input::all();
        Mail::send('emails.request-call', $data, function ($message) use ($data) {

            #$message->from(Config::get('mail.from.address'), Config::get('mail.from.name'));

            /**
             * Данные (адрес и имя) для отправки сообщения, берутся из словаря Опции
             */
            #/*
            $from_email = Dic::valueBySlugs('options', 'from_email');
            $from_email = is_object($from_email) && $from_email->name ? $from_email->name : (Config::get('mail.from.address') ?: 'no@reply.ru');
            $from_name = Dic::valueBySlugs('options', 'from_name');
            $from_name = is_object($from_name) && $from_name->name ? $from_name->name : (Config::get('mail.from.name') ?: 'No-reply');
            #*/

            /**
             * Адрес, на который будет отправлено письмо, берется из словаря Опции
             */
            $email = Dic::valueBySlugs('options', 'email');
            $email = is_object($email) && $email->name ? $email->name : (Config::get('mail.feedback.address') ?: 'dev@null.ru');

            /**
             * Если в адресе есть запятая - значит нужно отправить копию на все адреса
             */
            $ccs = array();
            if (strpos($email, ',')) {
                $ccs = explode(',', $email);
                foreach ($ccs as $e => $email)
                    $ccs[$e] = trim($email);
                $email = array_shift($ccs);
            }

            $message->from($from_email, $from_name);
            $message->subject('Зайцево: обратный звонок на номер ' . @$data['phone']);
            $message->to($email);

            if (isset($ccs) && is_array($ccs) && count($ccs))
                foreach ($ccs as $cc)
                    $message->cc($cc);
        });

        $json_request['status'] = TRUE;
        #$json_request['responseText'] = Input::all();

        return Response::json($json_request, 200);
    }


    public function postSendMessage() {

        $json_request = array('status' => FALSE, 'responseText' => '');

        /**
         * Более-менее стандартный функционал для отправки сообщения на e-mail
         */
        $data = Input::all();
        Mail::send('emails.feedback', $data, function ($message) use ($data) {

            #$message->from(Config::get('mail.from.address'), Config::get('mail.from.name'));

            /**
             * Данные (адрес и имя) для отправки сообщения, берутся из словаря Опции
             */
            #/*
            $from_email = Dic::valueBySlugs('options', 'from_email');
            $from_email = is_object($from_email) && $from_email->name ? $from_email->name : (Config::get('mail.from.address') ?: 'no@reply.ru');
            $from_name = Dic::valueBySlugs('options', 'from_name');
            $from_name = is_object($from_name) && $from_name->name ? $from_name->name : (Config::get('mail.from.name') ?: 'No-reply');
            #*/

            /**
             * Адрес, на который будет отправлено письмо, берется из словаря Опции
             */
            $email = Dic::valueBySlugs('options', 'email');
            $email = is_object($email) && $email->name ? $email->name : (Config::get('mail.feedback.address') ?: 'dev@null.ru');

            /**
             * Если в адресе есть запятая - значит нужно отправить копию на все адреса
             */
            $ccs = array();
            if (strpos($email, ',')) {
                $ccs = explode(',', $email);
                foreach ($ccs as $e => $email)
                    $ccs[$e] = trim($email);
                $email = array_shift($ccs);
            }

            $message->from($from_email, $from_name);
            $message->subject('Зайцево: обратная связь - ' . @$data['email']);
            $message->to($email);

            if (isset($ccs) && is_array($ccs) && count($ccs))
                foreach ($ccs as $cc)
                    $message->cc($cc);
        });

        $json_request['status'] = TRUE;
        #$json_request['responseText'] = Input::all();

        return Response::json($json_request, 200);

    }


    public function postArchitectsCompetition() {

        $json_request = array('status' => FALSE, 'responseText' => '');

        /**
         * Более-менее стандартный функционал для отправки сообщения на e-mail
         */
        $data = Input::all();
        Mail::send('emails.architects', $data, function ($message) use ($data) {

            #$message->from(Config::get('mail.from.address'), Config::get('mail.from.name'));

            /**
             * Данные (адрес и имя) для отправки сообщения, берутся из словаря Опции
             */
            #/*
            $from_email = Dic::valueBySlugs('options', 'from_email');
            $from_email = is_object($from_email) && $from_email->name ? $from_email->name : (Config::get('mail.from.address') ?: 'no@reply.ru');
            $from_name = Dic::valueBySlugs('options', 'from_name');
            $from_name = is_object($from_name) && $from_name->name ? $from_name->name : (Config::get('mail.from.name') ?: 'No-reply');
            #*/

            /**
             * Адрес, на который будет отправлено письмо, берется из словаря Опции
             */
            $email = Dic::valueBySlugs('options', 'email');
            $email = is_object($email) && $email->name ? $email->name : (Config::get('mail.feedback.address') ?: 'dev@null.ru');

            /**
             * Если в адресе есть запятая - значит нужно отправить копию на все адреса
             */
            $ccs = array();
            if (strpos($email, ',')) {
                $ccs = explode(',', $email);
                foreach ($ccs as $e => $email)
                    $ccs[$e] = trim($email);
                $email = array_shift($ccs);
            }

            $message->from($from_email, $from_name);
            $message->subject('Зайцево: заявка на конкурс архитекторов - ' . @$data['projname']);
            $message->to($email);

            /**
             * Прикрепляем файл
             */
            #/*
            if (Input::hasFile('file') && ($file = Input::file('file')) !== NULL) {
                #Helper::dd($file->getPathname() . ' / ' . $file->getClientOriginalName() . ' / ' . $file->getClientMimeType());
                $message->attach($file->getPathname(), array('as' => $file->getClientOriginalName(), 'mime' => $file->getClientMimeType()));
            }
            #*/

            if (isset($ccs) && is_array($ccs) && count($ccs))
                foreach ($ccs as $cc)
                    $message->cc($cc);
        });

        $json_request['status'] = TRUE;
        #$json_request['responseText'] = Input::all();

        return Response::json($json_request, 200);
    }

}