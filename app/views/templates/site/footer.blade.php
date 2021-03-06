<?
/**
 * TEMPLATE_IS_NOT_SETTABLE
 */
?>
<footer class="main-footer" data-_map--100p="background-position: 0 0%;" data-_map-10p="background-position: 0 -200%" data-_mapend-50p="background-position: 0 0%;">
            <div class="footer-houses" data-_map--100p="transform: translate(0, 0%) scale(1); background-size: auto 100%; background-repeat: no-repeat;" data-_map--50p="transform: translate(0, 120%) scale(1)" data-_mapend-50p="transform: translate(0, 0%) scale(1);">
                <div class="block-1 mil" data-_about--15p="opacity: 0;" data-_about--1p="opacity: 1;"></div>
                <div class="block-1 mil-tree" data-_about--15p="opacity: 0;" data-_about--1p="opacity: 1;"></div>
                <div class="block-1 right-tree-big" data-_about--25p="opacity: 0;" data-_about--11p="opacity: 1;"></div>
                <div class="block-1 mil-tree-group" data-_about--35p="opacity: 0;" data-_about--21p="opacity: 1;"></div>
                <div class="block-1 right-tree-small" data-_about--45p="opacity: 0;" data-_about--31p="opacity: 1;"></div>
                <div class="block-2 school" data-_areas--25p="opacity: 0;" data-_areas--11p="opacity: 1;"></div>
                <div class="block-2 near-school" data-_objects--45p="opacity: 0;" data-_objects--31p="opacity: 1;"></div>
                <div class="block-2 store" data-_objects--25p="opacity: 0;" data-_objects--11p="opacity: 1;" ></div>
                <div class="block-2 right-big" data-_areas--35p="opacity: 0;" data-_areas--21p="opacity: 1;"></div>
                <div class="block-2 right-small" data-_areas--45p="opacity: 0;" data-_areas--31p="opacity: 1;"></div>
                <div class="block-3 center-home" data-_houses--40p="opacity: 0;" data-_houses--21p="opacity: 1;"></div>
                <div class="block-3 horse" data-_houses--25p="opacity: 0;" data-_houses--11p="opacity: 1;"></div>
                <div class="block-3 little-horse" data-_houses--15p="opacity: 0;" data-_houses--1p="opacity: 1;"></div>
            </div>
            <div class="footer-cont" data-_map--100p="background-position: 0 0%; background-repeat: repeat-x" data-_map-10p="background-position: 0 -400%; background-repeat: no-repeat" data-_mapend-20p="background-position: 0 0%; background-repeat: repeat">

                <div class="copy">
                    © 2014 «Зайцево»
                </div>

                <div class="social">
                    <ul class="social-list">
                        <li class="social-item">
                            <a href="https://www.facebook.com/zaitsevo" target="_blank">
                                <span class="icon icon-facebook"></span>
                            </a>
                        </li>
                        <li class="social-item">
                            <a href="http://instagram.com/zaitsevo" target="_blank">
                                <span class="icon icon-instagram"></span>
                            </a>
                        </li>
                    </ul>
                </div>

                <div class="dev">
                    Сделано в <a href="http://grapheme.ru" target="_blank">Графема</a>
                </div>
            </div>
        </footer>

<div class="overlay">
    <div class="overlay-close js-popup-close">
        <span class="icon icon-cross"></span>
    </div>
    <div class="popup order-call" data-popup="order-call">
        <div class="popup-logo"></div>

        <form action="{{ URL::route('ajax.request-call') }}" method="POST" class="order-call-form">

            <fieldset>
                <input name="name" type="text" placeholder="Имя *">
            </fieldset>

            <fieldset>
                <input name="phone" class="phone-input" type="text" placeholder="Телефон *">
            </fieldset>

            <fieldset>
                <textarea name="text" placeholder="Комментарий"></textarea>
            </fieldset>

            <div class="order-call-hint">
                * - поля, отмеченные звездочкой, обязательны для заполнения
            </div>

            <button class="btn btn--big-green">
                Заказать звонок
            </button>
        </form>
    </div>
    <div class="popup leave-apply" data-popup="leave-apply">
        <div class="popup-logo"></div>
        <form action="{{ URL::route('ajax.architects-competition') }}" method="POST" class="leave-apply-form clearfix">

            <div class="clearfix">
                <div class="column column-half">

                    <fieldset>

                        <h3>Номинация</h3>

                        <div class="checkbox-cont">
                            <input type="checkbox" id="check-1" name="nomination[ecohouse]" value="1" class="checkbox"><label for="check-1" class="checkbox-label">Эко-дом</label>

                            <input type="checkbox" id="check-2" name="nomination[landscape]" value="1" class="checkbox"><label for="check-2" class="checkbox-label">Ландшафтная архитектура</label>
                        </div>

                       <!--  <input class="input" type="text" name="projname" placeholder="Название проекта *"> -->
                    </fieldset>

                    <fieldset>

                        <h3>Заявитель</h3>

                        <input class="input" type="text" name="zname" placeholder="ФИО заявителя">

                        <textarea name="address" placeholder="Рассказ о своем проекте *"></textarea>

                        <div class="inv-person-data clearfix">
                            <input type="text" name="email" placeholder="Email *"><!--
								 --><input type="text" name="phone" placeholder="Телефон *"><!--
								 --><input type="text" name="site" placeholder="Веб-сайт">
                        </div>
                    </fieldset>

                    <fieldset class="file-inputs">

                        <h3>Прикрепите изображения</h3>

                        <input type="file" name="file">

                        <p>
                            Архив (zip, rar, 7z), содержащий графические файлы к проекту в формате JPEG, размером не менее 3500х2500, включающие: 3d-визуализации, поэтажные планы (не менее двух разрезов), фасады.
                        </p>
                        <p>
                            * - поля, отмеченные звездочкой, обязательны для заполнения
                        </p>

                    </fieldset>
                </div>

                <div class="column column-half">

                    <fieldset>

                        <h3>Критерии оценки</h3>

                        <ul class="mark-criteries">

                            <li class="mark-criteria">
                                <div class="mark-criteria-head">
                                    Технико­экономический
                                </div>
                                <div class="mark-criteria-body">
                                    Решение должно быть пространство­эффективным и иметь
                                    потенциал для реализации.
                                </div>
                            </li>

                            <li class="mark-criteria">
                                <div class="mark-criteria-head">
                                    Визуальная привлекательность
                                </div>
                                <div class="mark-criteria-body">
                                    Решение должно быть визуально привлекательным и легкоадаптироваться в окружающей среде.
                                </div>
                            </li>

                            <li class="mark-criteria">
                                <div class="mark-criteria-head">
                                    Экономическая эффективность
                                </div>
                                <div class="mark-criteria-body">

                                </div>
                            </li>

                            <li class="mark-criteria">
                                <div class="mark-criteria-head">
                                    Инновационность
                                </div>
                                <div class="mark-criteria-body">
                                    Решение должно быть оригинальным и свежим.
                                </div>
                            </li>

                            <li class="mark-criteria">
                                <div class="mark-criteria-head">
                                    Долголетие
                                </div>
                                <div class="mark-criteria-body">
                                    Решение должно быть пригодным для долгосрочного использования и иметь
                                    возможность для обновления в свете технологических изменений.
                                </div>
                            </li>

                            <li class="mark-criteria">
                                <div class="mark-criteria-head">
                                    Гибкость
                                </div>
                                <div class="mark-criteria-body">
                                    Решение должно иметь возможность повторения.
                                </div>
                            </li>
                        </ul>

                        <h3>Сроки</h3>

                        <div class="deadline">
                            <div>
                                <strong>Последний срок подачи работ:</strong> 1 августа 2015 года.
                            </div>
                            <div>
                                <strong>Объявление победителей:</strong> 15 сентября 2015 года.
                            </div>
                            <div>
                                <strong>Язык конкурса:</strong> русский.
                            </div>
                        </div>
                        
                    </fieldset>

                </div>
            </div>

            <div class="btn-cont">
                <button class="btn btn--big-green">
                    Отправить заявку
                </button>
            </div>
        </form>
    </div>
</div>
