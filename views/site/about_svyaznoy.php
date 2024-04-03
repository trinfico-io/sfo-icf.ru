<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\bootstrap\Tabs;


if (isset($test))
    $test = " - тестовая страница";
else
    $test = ".";

$this->title = 'Приём платежей'.$test;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= $this->title ?></h1>
    <div class="body-content">
    	<h3>Уважаемый Заемщик, Вы можете оплатить задолженность по кредиту следующими способами:</h3>


        <div class="tabs">



        <!-- INPUTS -->

            <input id="tab1"  type="radio" name="tabs" checked>
            <label for="tab1" class="t1"  title="Перевод средств Новому кредитору. В назначении платежа необходимо обязательно указать: номер карты или номер кредитного договора или ЕАН или Идентификационный номер (номер был выслан Вам смс-сообщением).">Межбанковским переводом по реквизитам</label>


            <input id="tab2" type="radio" name="tabs">
            <label for="tab2" class="t2" title="Через ВТБ Онлайн">В ВТБ Онлайн</label>
<?php /* is#14141
            <input id="tab3" type="radio" name="tabs">
            <label for="tab3" class="t3" title="За внесение через терминал комиссия не взимается" >В терминалах платежной сети QIWI без комиссии</label>

            <a  class="t4"  target="blank" href="https://qiwi.com/payment/form.action?provider=32994">Онлайн на сайте QIWI без комиссии</a>
            <input id="tab4"  type="radio" name="tabs" >
*/ ?>

            <label for="tab4" class="t5" title="При платеже банковской картой онлайн комиссия не взимается">Банковской картой онлайн</label>

     <!-- INPUTS -->






        <!-- end of row 2 -->
            <section id="content-tab1">
                <div>
                	<h2>Реквизиты Нового кредитора для оплаты задолженности</h2>
                	<p>
                		<ul>
                			<li><b>Получатель:</b>&nbsp;Общество с ограниченной ответственностью &laquo;Специализированное финансовое общество ИнвестКредит Финанс&raquo;</li>
                			<li><b>ОГРН:</b>&nbsp;1167746649993</li>
                			<li><b>ИНН:</b>&nbsp;7702403476</li>
                			<li><b>КПП:</b>&nbsp;770201001</li>
                			<li><b>Реквизиты счета:</b><br>
                				<ul>
                        			<li><b>р/с:</b>&nbsp;40701810400260000265 в Банк ВТБ (ПАО)</li>
                        			<li><b>к/с:</b>&nbsp;30101810700000000187</li>
                        		</ul>
                			</li>
                			<li><b>БИК:</b>&nbsp;044525187</li>
                			<li><b>Назначение платежа:</b>&nbsp;<br>
                				<p style="margin-left: 25px;">
                				Оплата задолженности. <br>
                                Фамилия Имя Отчество. <br>
                                Идентификационный номер (номер был выслан Вам смс-сообщением)<br>
                                и/или <br>
                                ЕАН <sup style="color: red;" title="номер под штрих-кодом на обратной стороне карты 13 цифр, начинающихся с 2989">*</sup> 2989<b>ХХХХХХХХХ</b> <br>
                                и/или <br>
                                Номер карты <b>ХХХХ ХХХХ ХХХХ ХХХХ</b> <br>
                                и/или <br>
                                Кредитный договор №  ___ от &laquo;__&raquo; _____ 20__г. <br>
                                </p>
                                <span style="color: red; font-size:10px;"><sup>*</sup> (ЕАН – номер под штрих-кодом на обратной стороне карты 13 цифр, начинающихся с 2989)</span>
                			</li>
                		</ul>
                	</p>

                </div>
            </section>
            <section id="content-tab2">
                <div>
                <?php
                    echo Tabs::widget([
                        'items' => [
                            [
                                'label' => 'Через ВТБ Онлайн',
                                'content' => $this->render('vtb/_vtb_online'),
                                'active' => true,
                            ],
                            [
                                'label' => 'Через мобильное приложение ВТБ Онлайн',
                                'content' => $this->render('vtb/_vtb_mobile'),
                            ],
                        ],
                    ]);

                ?>
                </div>
            </section>
<?php /* is#14141
            <section id="content-tab3">
                <div>
                  <p align="center">За внесение через терминал комиссия не взимается.</p>
                  <p></p>
                  <p style="text-align: center;"><a style="background-color: #008ccf; border-color: #094593; color:White;" class="btn btn-lg btn-success" href="https://qiwi.com/replenish/map.action" target="_blank">Найти терминал QIWI на карте</a></p>
                  <ol style="font-size: 24px; text-align: center;">
                    <li>
                        <h3>Главная страница интерфейса терминала. Нажать кнопку Оплата услуг.</h3>
                        <img src="/img/qiwi/1.png" border="0"/>
                    </li>
                    <li>
                        <h3>Нажать кнопку Поиск</h3>
                        <img src="/img/qiwi/2.png" border="0"/>
                    </li>
                    <li>
                        <h3>Начать набирать название на клавиатуре, нажать на логотип</h3>
                        <img src="/img/qiwi/3.png" border="0"/>
                    </li>
                    <li>
                        <h3>Ввести уникальный идентификатор. Нажать кнопку Далее.</h3>
                        <img src="/img/qiwi/4.png" border="0"/>
                    </li>
                    <li>
                        <h3>Отобразится информация – ФИО и сумма задолженности</h3>
                        <img src="/img/qiwi/5.png" border="0"/>
                    </li>
                    <li>
                        <h3>Ввести сумму платежа. Нажать кнопку Далее</h3>
                        <img src="/img/qiwi/6.png" border="0"/>
                    </li>
                    <li>
                        <h3>Выбрать вариант перечисления сдачи. Нажать кнопку Далее</h3>
                        <img src="/img/qiwi/7.png" border="0"/>
                    </li>
                    <li>
                        <h3>Ввести номер телефона. Нажать кнопку Далее</h3>
                        <img src="/img/qiwi/8.png" border="0"/>
                    </li>
                    <li>
                        <h3>Нажать кнопку Далее.</h3>
                        <img src="/img/qiwi/9.png" border="0"/>
                    </li>
                    <li>
                        <h3>Внести деньги. Нажать кнопку Оплатить.</h3>
                        <img src="/img/qiwi/10.png" border="0"/>
                    </li>

                  </ol>
                </div>
            </section>
            <section id="content-tab4">
                <div>
                    <p>Оплатить Вашу задолженность можно с помощью банковских карт международных платёжных систем Visa International, MasterCard Worldwide и платежной системы &laquo;Мир&raquo;.</p>

                    <p>При оплате банковской картой безопасность платежей гарантирует процессинговый центр <a href="https://best2pay.ru/" target="_blank">Best2Pay</a>.</p>

                    <p>Приём платежей происходит через защищённое безопасное соединение, используя протокол TLS 1.2.</p>

                    <p>Компания <a href="https://best2pay.ru/" target="_blank">Best2Pay</a> работает в соответствии с международными требованиями PCI DSS для обеспечения
                    безопасной обработки реквизитов банковской карты плательщика. Ваши конфиденциальные данные, необходимые для оплаты (реквизиты карты, регистрационные данные и др.),
                    не поступают к получателю платежа, их обработка производится на стороне процессингового центра <a href="https://best2pay.ru/" target="_blank">Best2Pay</a>
                    и полностью защищена.</p>

                    <p>Никто, в том числе Общество с ограниченной ответственностью СФО ИнвестКредит Финанс, не может получить банковские и персональные данные плательщика.</p>

                    <p>В случае ошибочно произведенного платежа возврат денежных средств будет осуществлен на ту же самую карту, с которой произведен платеж.</p>

                    <p style="text-align:center;"><a style="background-color: #0163a4; border-color: #041436;" class="btn btn-lg btn-success" href="https://payment.sfo-icf.ru/b2p/">
                        Произвести оплату без комиссии</a></p>
                </div>
            </section>
*/ ?>
            <section id="content-tab5">
                <div>
                    <h3>Ограничения по предоставлению услуги</h3>
                    <p>
                        <ul style="font-weight:bolder;">
                            <li>Комиссия за услугу&mdash;0&nbsp;руб.</li>
                            <li>Минимальная сумма платежа&mdash;10&nbsp;руб.</li>
                            <li>Максимальная сумма платежа&mdash;15&nbsp;000&nbsp;руб.</li>
                        </ul>
                    </p>
                    <ol style="font-size: 24px; text-align: center;">
                        <li>
                            <h3>Для проведения платежа на терминале оплаты на экране терминала необходимо нажать кнопку: <b>&laquo;Банковские карты и платежи&raquo;</b></h3>
                            <img style="width:930px;" src="/img/svyaznoy/svyaznoy_1.png">
                        </li>
                        <li>
                            <h3>Затем на экране нажать <b>&laquo;Поиск&raquo;</b> и найти услугу <b>&laquo;ИнвестКредит Финанс погашение займа&raquo;</b></h3>
                            <img style="width:930px;" src="/img/svyaznoy/svyaznoy_2_hide.png">
                        </li>
                        <li>
                            <h3>Далее необходимо выбрать услугу <b>&laquo;ИнвестКредит Финанс погашение займа&raquo;</b></h3>
                        </li>
                        <li>
                            <h3>Далее необходимо ввести <b><u>уникальный идентификатор</u></b></h3>
                            <img style="width:930px;" src="/img/svyaznoy/svyaznoy_3.png">
                        </li>
                        <li>
                            <h3>После ввода корректного уникального идентификатора появляется окно с надписью &laquo;Абонент найден&raquo;</h3>
                        </li>
                        <li>
                            <h3>Внесите желаемую сумму и заберите чек.
                            В случае переплаты сверх задолженности, обратитесь в АО &laquo;ФАСП&raquo; с запросом о возврате переплаты  и предоставьте ваши банковские реквизиты для перечисления.</h3>
                            <img style="width:930px;" src="/img/svyaznoy/svyaznoy_4.png">
                        </li>
                    </ol>
                </div>
            </section>
        </div>


    </div>
</div>
