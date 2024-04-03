<?php

use yii\bootstrap\Button;
use yii\helpers\Html;
use yii\bootstrap\Modal;
use yii\bootstrap\Collapse;

/* @var $this yii\web\View */
// Калугин Д.Е, 23.10.2018 файл переименован пло письму Ольги (добавлен суффикс _old)

$this->title = 'Информация для заемщиков';
?>
<div class="site-index">
    <div class="body-content">
        <div class="row" style="text-align: center;">
            Раскрытие информации в соответствии с требованиями законодательства Российской Федерации осуществляется по адресу<br>
            <?php echo Html::a('https://www.e-disclosure.ru/portal/company.aspx?id=37455', 'https://www.e-disclosure.ru/portal/company.aspx?id=37455', ['target' => '_blank'])?>
        </div>
        <div class="row">&nbsp;</div>
        <div class="row" style="text-align: center;">
            <?php echo Html::a('Правила внутреннего контроля по предотвращению, выявлению и пресечению неправомерного использования инсайдерской информации и (или) манипулирования рынком'
                , '/site/getfile?id=222', ['target' => '_blank'])?>
        </div>
        <div class="row" style="text-align: center;"><a href="/site/getfile?id=210" target="_blank">Перечень инсайдерской информации</a></div>
        <div class="row">&nbsp;</div>
        <div class="row">&nbsp;</div>
        <div class="row">
            <div class="credcheck-banner" style="width: 90%;  margin-left: 5%; background: linear-gradient(95.92deg, #6B83C2 0%, #6667AB 100%); padding: 40px 24px 20px; display: flex; justify-content: center; flex-wrap: wrap; position: relative">
                <div class="credcheck-banner__label" style="position: absolute; bottom: 0; right: 20px; background: #F1F2F5; padding: 2px 4px; border-radius: 4px 4px 0 0; color: #3E3E50; font-size: 10px; line-height: 12px;">Реклама</div>
                <div class="credcheck-banner__content" style="display: flex; flex-direction: column; margin-right: 96px; width: 550px">
                  <div class="credcheck-banner__content__title" style="font-weight: 700; font-size: 20px; line-height: 28px; color: #FFFFFF;">Проверить информацию о долгах и платежах в кредитной истории. Всегда бесплатно!</div>
                  <a href="https://credcheck.ru/?utm_source=sfoicf&erid=LjN8JxLma" target="_blank" class="credcheck-banner__content__button" onmouseover="this.style.color='#523F90'" style="text-decoration: none; color: #523F90; background: white; padding: 8px 32px; border-radius: 8px; width: fit-content; margin-top: 20px; margin-bottom: 20px">Проверить</a>
                </div>
            
                <img style="margin-bottom: 20px" src='data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMTE2IiBoZWlnaHQ9IjEwNCIgdmlld0JveD0iMCAwIDExNiAxMDQiIGZpbGw9Im5vbmUiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+DQo8ZyBjbGlwLXBhdGg9InVybCgjY2xpcDBfMzE5OF8yNTAzNykiPg0KPHBhdGggZD0iTTEwLjc5MTQgOTkuNTA0NkMxMC40NTEyIDk4LjgxMDIgMTAuMTMxMyA5OC4xNTgyIDkuODMxNjcgOTcuNTQ4NkM5LjUzMjAyIDk2LjkzMTMgOS4yMzY0MiA5Ni4zMjE4IDguOTQ0ODYgOTUuNzE5OUw3LjQ4NzA5IDkyLjc1NjlINi40MDU5MUw2LjgwNjggODkuMDUzMkg3LjgxNTA5TDkuNjEzMDEgODYuNjgwNkMxMC4wNDIyIDg2LjExNzMgMTAuNDY3NCA4NS41NTQgMTAuODg4NiA4NC45OTA3QzExLjMxNzggODQuNDE5OCAxMS44MTU5IDgzLjc1NjIgMTIuMzgyOCA4M0gxOC4yMDE3QzE3LjQ0MDQgODMuODg3MyAxNi42OTEzIDg0Ljc2NyAxNS45NTQzIDg1LjYzODlDMTUuMjE3MyA4Ni41MDMxIDE0LjQ3MjMgODcuMzc1IDEzLjcxOTEgODguMjU0NkwxMC44NzY0IDkxLjU5OTVMMTAuODUyMSA4OS40OTMxTDEzLjIwODggOTMuNTkwM0MxMy41NzMzIDk0LjIwNzYgMTMuOTYyIDk0Ljg3ODkgMTQuMzc1MSA5NS42MDQyQzE0Ljc5NjIgOTYuMzI5NSAxNS4yMDUyIDk3LjAzNTUgMTUuNjAyIDk3LjcyMjJDMTUuOTk4OSA5OC40MDEyIDE2LjM0MzEgOTguOTk1NCAxNi42MzQ2IDk5LjUwNDZIMTAuNzkxNFpNMSA5OS41MDQ2QzEuMDk3MTggOTguNjMyNyAxLjE5MDMyIDk3Ljc4NzggMS4yNzk0MSA5Ni45Njk5QzEuMzY4NDkgOTYuMTUyIDEuNDczNzggOTUuMjE4NCAxLjU5NTI2IDk0LjE2OUwyLjIyNjk2IDg4LjUzMjRDMi4zNDg0NCA4Ny40NTIyIDIuNDUzNzIgODYuNDg3NyAyLjU0MjgxIDg1LjYzODlDMi42Mzk5OSA4NC43ODI0IDIuNzQxMjMgODMuOTAyOCAyLjg0NjUxIDgzSDcuODM5MzhDNy43NDIyIDgzLjg5NTEgNy42NDUwMSA4NC43NzA4IDcuNTQ3ODMgODUuNjI3M0M3LjQ1MDY0IDg2LjQ4MzggNy4zNDEzMSA4Ny40NTIyIDcuMjE5ODMgODguNTMyNEw2LjYwMDI4IDk0LjE1NzRDNi40Nzg4IDk1LjIxNDUgNi4zNzM1MSA5Ni4xNTIgNi4yODQ0MyA5Ni45Njk5QzYuMTk1MzQgOTcuNzg3OCA2LjA5ODE2IDk4LjYzMjcgNS45OTI4NyA5OS41MDQ2SDFaIiBmaWxsPSJ3aGl0ZSIvPg0KPHBhdGggZD0iTTE4LjM2OCA5OS41MDQ2QzE4LjQ2NTIgOTguNjMyNyAxOC41NTgzIDk3Ljc4NzggMTguNjQ3NCA5Ni45Njk5QzE4LjczNjUgOTYuMTUyIDE4Ljg0MTggOTUuMjE0NSAxOC45NjMzIDk0LjE1NzRMMTkuNTk1IDg4LjUzMjRDMTkuNzE2NCA4Ny40NDQ0IDE5LjgyMTcgODYuNDc2MSAxOS45MTA4IDg1LjYyNzNDMjAuMDA4IDg0Ljc3MDggMjAuMTA5MiA4My44OTUxIDIwLjIxNDUgODNDMjAuOTE5MSA4MyAyMS44OTkgODMgMjMuMTU0NCA4M0MyNC40MTc4IDgzIDI1Ljg3MTUgODMgMjcuNTE1NSA4M0MyOC45NjUyIDgzIDMwLjE2NzkgODMuMTg5IDMxLjEyMzUgODMuNTY3MUMzMi4wNzkyIDgzLjkzNzUgMzIuNzY3NiA4NC41NDMyIDMzLjE4ODcgODUuMzg0M0MzMy42MDk4IDg2LjIyNTMgMzMuNzQzNSA4Ny4zNDQxIDMzLjU4OTYgODguNzQwN0MzMy40NjgxIDg5Ljg3NSAzMy4xNjQ0IDkwLjg0NzIgMzIuNjc4NSA5MS42NTc0QzMyLjE5MjUgOTIuNDU5OSAzMS40ODggOTMuMDc3MiAzMC41NjQ3IDkzLjUwOTNDMjkuNjQxNCA5My45NDE0IDI4LjQ1OSA5NC4xNTc0IDI3LjAxNzUgOTQuMTU3NEMyNi42Mjg3IDk0LjE1NzQgMjYuMjAzNSA5NC4xNTc0IDI1Ljc0MTkgOTQuMTU3NEMyNS4yODAzIDk0LjE1NzQgMjQuODMwOCA5NC4xNTc0IDI0LjM5MzUgOTQuMTU3NEMyMy45NjQyIDk0LjE1NzQgMjMuNTk1NyA5NC4xNTc0IDIzLjI4OCA5NC4xNTc0TDIzLjY2NDYgOTAuNzA4M0gyNi4xOTE0QzI2LjcwMTYgOTAuNzA4MyAyNy4xMTg3IDkwLjY0MjcgMjcuNDQyNiA5MC41MTE2QzI3Ljc2NjYgOTAuMzcyNyAyOC4wMTM2IDkwLjE1NjYgMjguMTgzNyA4OS44NjM0QzI4LjM1MzcgODkuNTcwMiAyOC40NjcxIDg5LjE4ODMgMjguNTIzOCA4OC43MTc2QzI4LjU2NDMgODguMzQ3MiAyOC41NDQxIDg4LjAzMDkgMjguNDYzMSA4Ny43Njg1QzI4LjM5MDIgODcuNTA2MiAyOC4yNjg3IDg3LjI5NCAyOC4wOTg2IDg3LjEzMTlDMjcuOTM2NyA4Ni45Njk5IDI3Ljc0MjMgODYuODUwMyAyNy41MTU1IDg2Ljc3MzFDMjcuMjk2OSA4Ni42OTYgMjcuMDU3OSA4Ni42NTc0IDI2Ljc5ODggODYuNjU3NEgyMi4zNTI2TDI1LjAzNzMgODMuNzYzOUMyNC45NDAxIDg0LjY2NjcgMjQuODQyOSA4NS41NDYzIDI0Ljc0NTggODYuNDAyOEMyNC42NTY3IDg3LjI1MTUgMjQuNTQ3MyA4OC4yMTYxIDI0LjQxNzggODkuMjk2M0wyMy44ODMyIDk0LjE2OUMyMy43NjE4IDk1LjIxODQgMjMuNjU2NSA5Ni4xNTIgMjMuNTY3NCA5Ni45Njk5QzIzLjQ3ODMgOTcuNzgwMSAyMy4zODUyIDk4LjYyNSAyMy4yODggOTkuNTA0NkgxOC4zNjhaIiBmaWxsPSJ3aGl0ZSIvPg0KPHBhdGggZD0iTTM0LjQzMSA5OS41MDQ2QzM0LjUyODIgOTguNjMyNyAzNC42MjEzIDk3Ljc4NzggMzQuNzEwNCA5Ni45Njk5QzM0Ljc5OTUgOTYuMTUyIDM0LjkwNDggOTUuMjE0NSAzNS4wMjYzIDk0LjE1NzRMMzUuNjU4IDg4LjUzMjRDMzUuNzc5NSA4Ny40NDQ0IDM1Ljg4NDcgODYuNDc2MSAzNS45NzM4IDg1LjYyNzNDMzYuMDcxIDg0Ljc3ODYgMzYuMTcyMyA4My45MDI4IDM2LjI3NzUgODNINDguMTgyN0w0Ny43Njk2IDg2LjgwNzlDNDcuMDU3IDg2LjgwNzkgNDYuMjk1NyA4Ni44MDc5IDQ1LjQ4NTggODYuODA3OUM0NC42NzU5IDg2LjgwNzkgNDMuNzIwMyA4Ni44MDc5IDQyLjYxODggODYuODA3OUgzOC42NzA3TDQxLjA3NiA4My43NjM5QzQwLjk3ODkgODQuNjU5IDQwLjg4MTcgODUuNTM0NyA0MC43ODQ1IDg2LjM5MTJDNDAuNjk1NCA4Ny4yNCA0MC41OTAxIDg4LjIwNDUgNDAuNDY4NiA4OS4yODQ3TDQwLjAwNyA5My4zOTM1QzM5Ljg5MzYgOTQuNDM1MiAzOS43OTI0IDk1LjM2ODggMzkuNzAzMyA5Ni4xOTQ0QzM5LjYxNDIgOTcuMDEyMyAzOS41MjExIDk3Ljg1NzMgMzkuNDIzOSA5OC43MjkyTDM4LjAxNDcgOTUuNjk2OEg0MS45NzVDNDIuODkwMiA5NS42OTY4IDQzLjc1MjcgOTUuNjk2OCA0NC41NjI1IDk1LjY5NjhDNDUuMzgwNSA5NS42OTY4IDQ2LjE3MDEgOTUuNjk2OCA0Ni45MzE0IDk1LjY5NjhMNDYuNDk0MSA5OS41MDQ2SDM0LjQzMVpNMzguOTEzNyA5Mi45NDIxTDM5LjI5MDMgODkuNDgxNUg0Mi4zNTE2QzQzLjM4MDEgODkuNDgxNSA0NC4yNjI5IDg5LjQ4MTUgNDQuOTk5OSA4OS40ODE1QzQ1Ljc0NSA4OS40ODE1IDQ2LjQ2MTcgODkuNDgxNSA0Ny4xNTAxIDg5LjQ4MTVMNDYuNzYxNCA5Mi45NDIxQzQ2LjAzMjUgOTIuOTQyMSA0NS4yOTk1IDkyLjk0MjEgNDQuNTYyNSA5Mi45NDIxQzQzLjgzMzcgOTIuOTQyMSA0Mi45NjcxIDkyLjk0MjEgNDEuOTYyOCA5Mi45NDIxSDM4LjkxMzdaIiBmaWxsPSJ3aGl0ZSIvPg0KPHBhdGggZD0iTTU5Ljk1NzQgOTguNzI5MkM2MC4wNTQ2IDk3Ljg2NSA2MC4xNDc3IDk3LjAyMDEgNjAuMjM2OCA5Ni4xOTQ0QzYwLjMzNCA5NS4zNjg4IDYwLjQzOTMgOTQuNDM1MiA2MC41NTI3IDkzLjM5MzVMNjEuMDE0MyA4OS4yODQ3QzYxLjEzNTggODguMjA0NSA2MS4yNDExIDg3LjIzNjEgNjEuMzMwMiA4Ni4zNzk2QzYxLjQyNzMgODUuNTIzMSA2MS41MjQ1IDg0LjY1MTIgNjEuNjIxNyA4My43NjM5TDYyLjYzIDg2Ljk0NjhINTUuMTgzMkw1Ny45NjUxIDgzLjk5NTRDNTcuODAzMiA4NC45MjkgNTcuNjQ1MiA4NS44NjY1IDU3LjQ5MTQgODYuODA3OUM1Ny4zMzc1IDg3Ljc0OTIgNTcuMTc5NiA4OC42OTA2IDU3LjAxNzYgODkuNjMxOUM1Ni44NDc1IDkwLjY4MTMgNTYuNjY1MyA5MS41ODggNTYuNDcwOSA5Mi4zNTE5QzU2LjI3NjUgOTMuMTA4IDU2LjAyNTUgOTMuNzc1NSA1NS43MTc3IDk0LjM1NDJDNTUuNDEgOTQuOTMyOSA1NC45OTI5IDk1LjQ4MDcgNTQuNDY2NSA5NS45OTc3TDQ5LjYxOTQgOTUuNTY5NEM0OS45OTE5IDk1LjMzMDIgNTAuMzYwNCA5NC45NDA2IDUwLjcyNDkgOTQuNDAwNUM1MS4wOTc0IDkzLjg1MjYgNTEuNDQ1NiA5My4xMTE5IDUxLjc2OTYgOTIuMTc4MkM1Mi4xMDE2IDkxLjIzNjkgNTIuMzgxMSA5MC4wNjc5IDUyLjYwNzggODguNjcxM0M1Mi43Njk4IDg3LjY2ODIgNTIuOTMxOCA4Ni42ODgzIDUzLjA5MzcgODUuNzMxNUM1My4yNTU3IDg0Ljc3NDcgNTMuNDA1NSA4My44NjQyIDUzLjU0MzIgODNINjYuNzM2MUM2Ni42MzA4IDgzLjg5NTEgNjYuNTI5NSA4NC43NzA4IDY2LjQzMjQgODUuNjI3M0M2Ni4zNDMzIDg2LjQ3NjEgNjYuMjM4IDg3LjQ0ODMgNjYuMTE2NSA4OC41NDRMNjUuNTY5OCA5My4zOTM1QzY1LjQ1NjUgOTQuNDM1MiA2NS4zNTEyIDk1LjM2ODggNjUuMjU0IDk2LjE5NDRDNjUuMTY0OSA5Ny4wMjAxIDY1LjA3MTggOTcuODY1IDY0Ljk3NDYgOTguNzI5Mkg1OS45NTc0Wk00Ny40MzI3IDEwM0M0Ny40OTc1IDEwMi4zOTggNDcuNTY2NCAxMDEuNzg5IDQ3LjYzOTIgMTAxLjE3MUM0Ny43MDQgMTAwLjU2MiA0Ny43Njg4IDk5Ljk1NiA0Ny44MzM2IDk5LjM1NDJDNDcuOTA2NSA5OC43MjkyIDQ3Ljk3OTQgOTguMDk2NSA0OC4wNTIzIDk3LjQ1NkM0OC4xMjUyIDk2LjgxNTYgNDguMTk0IDk2LjE4MjkgNDguMjU4OCA5NS41NTc5QzQ5LjM4NDUgOTUuNTU3OSA1MC41MjY0IDk1LjU1NzkgNTEuNjg0NiA5NS41NTc5QzUyLjg0MjcgOTUuNTU3OSA1My45Njg0IDk1LjU1NzkgNTUuMDYxNyA5NS41NTc5SDYwLjc1OTJDNjEuODYwNiA5NS41NTc5IDYyLjk4NjQgOTUuNTU3OSA2NC4xMzY0IDk1LjU1NzlDNjUuMjk0NSA5NS41NTc5IDY2LjQzNjQgOTUuNTU3OSA2Ny41NjIxIDk1LjU1NzlDNjcuNDg5MyA5Ni4xODI5IDY3LjQxNjQgOTYuODE1NiA2Ny4zNDM1IDk3LjQ1NkM2Ny4yNzg3IDk4LjA5NjUgNjcuMjA5OCA5OC43MjkyIDY3LjEzNyA5OS4zNTQyQzY3LjA3MjIgOTkuOTU2IDY3LjAwMzMgMTAwLjU2MiA2Ni45MzA0IDEwMS4xNzFDNjYuODY1NiAxMDEuNzgxIDY2LjgwMDkgMTAyLjM5IDY2LjczNjEgMTAzSDYyLjU1NzFMNjIuNzUxNSA5OC43NjM5TDYzLjQ4MDQgOTkuNTA0Nkg1MS40NTM3TDUyLjM1MjcgOTguNzYzOUw1MS42MTE3IDEwM0g0Ny40MzI3WiIgZmlsbD0id2hpdGUiLz4NCjxwYXRoIGQ9Ik03Ny40NDEyIDk5LjUwNDZDNzcuNTMwMyA5OC43MDIyIDc3LjYxNTMgOTcuOTExMyA3Ny42OTYzIDk3LjEzMTlDNzcuNzg1NCA5Ni4zNTI2IDc3Ljg4NjYgOTUuNDczIDc4IDk0LjQ5MzFMNzguMDcyOSA5My42OTQ0Qzc3LjY5MjMgOTMuODI1NiA3Ny4zMTE2IDkzLjkzNzUgNzYuOTMxIDk0LjAzMDFDNzYuNTU4NCA5NC4xMjI3IDc2LjE1NzYgOTQuMTk2IDc1LjcyODMgOTQuMjVDNzUuMjk5MSA5NC4zMDQgNzQuODE3MiA5NC4zMzEgNzQuMjgyNyA5NC4zMzFDNzMuMTA4NCA5NC4zMzEgNzIuMDgzOSA5NC4xMjI3IDcxLjIwOTIgOTMuNzA2QzcwLjM0MjcgOTMuMjgxNiA2OS42OTg4IDkyLjY2MDUgNjkuMjc3NyA5MS44NDI2QzY4Ljg1NjUgOTEuMDI0NyA2OC43MTQ4IDkwLjAxNzcgNjguODUyNSA4OC44MjE4QzY4Ljg3NjggODguNjIxMSA2OC44OTcgODguNDM2IDY4LjkxMzIgODguMjY2MkM2OC45Mjk0IDg4LjA5NjUgNjguOTQ5NyA4Ny45MTUxIDY4Ljk3NCA4Ny43MjIyQzY5LjA3MTIgODYuNzg4NiA2OS4xNTYyIDg1Ljk1OTEgNjkuMjI5MSA4NS4yMzM4QzY5LjMwMiA4NC41MDg1IDY5LjM3ODkgODMuNzYzOSA2OS40NTk5IDgzSDc0LjQ4OTJDNzQuMzgzOSA4My45NTY4IDc0LjI4NjggODQuODE3MSA3NC4xOTc3IDg1LjU4MUM3NC4xMTY3IDg2LjMzNzIgNzQuMDMxNiA4Ny4xMjA0IDczLjk0MjYgODcuOTMwNkw3My44ODE4IDg4LjUwOTNDNzMuODQxMyA4OC44OTUxIDczLjg3NzggODkuMjUgNzMuOTkxMSA4OS41NzQxQzc0LjExMjYgODkuODkwNCA3NC4zMzk0IDkwLjE0NTEgNzQuNjcxNCA5MC4zMzhDNzUuMDExNiA5MC41MjMxIDc1LjQ3NzMgOTAuNjE1NyA3Ni4wNjg1IDkwLjYxNTdDNzYuMzg0MyA5MC42MTU3IDc2LjY3OTkgOTAuNTk2NSA3Ni45NTUzIDkwLjU1NzlDNzcuMjM4NyA5MC41MTE2IDc3LjUwNiA5MC40NDk4IDc3Ljc1NzEgOTAuMzcyN0M3OC4wMDgxIDkwLjI5NTUgNzguMjUxMSA5MC4xOTkxIDc4LjQ4NTkgOTAuMDgzM0w3OC42NTYgODguNTMyNEM3OC43Nzc1IDg3LjQ1MjIgNzguODg2OCA4Ni40ODc3IDc4Ljk4NCA4NS42Mzg5Qzc5LjA4MTIgODQuNzgyNCA3OS4xNzg0IDgzLjkwMjggNzkuMjc1NiA4M0g4NC4zMDQ5Qzg0LjIwNzcgODMuOTAyOCA4NC4xMTA1IDg0Ljc3ODYgODQuMDEzMyA4NS42MjczQzgzLjkxNjEgODYuNDc2MSA4My44MDY4IDg3LjQ0NDQgODMuNjg1MyA4OC41MzI0TDgzLjA2NTggOTQuMTU3NEM4Mi45NDQzIDk1LjIxNDUgODIuODM5IDk2LjE1MiA4Mi43NDk5IDk2Ljk2OTlDODIuNjYwOCA5Ny43ODc4IDgyLjU2NzcgOTguNjMyNyA4Mi40NzA1IDk5LjUwNDZINzcuNDQxMloiIGZpbGw9IndoaXRlIi8+DQo8cGF0aCBkPSJNODUuMjUzOCA5OS41MDQ2Qzg1LjM1MSA5OC42MzI3IDg1LjQ0NDEgOTcuNzg3OCA4NS41MzMyIDk2Ljk2OTlDODUuNjIyMyA5Ni4xNTIgODUuNzI3NSA5NS4yMTQ1IDg1Ljg0OSA5NC4xNTc0TDg2LjQ4MDcgODguNTMyNEM4Ni42MDIyIDg3LjQ0NDQgODYuNzA3NSA4Ni40NzYxIDg2Ljc5NjYgODUuNjI3M0M4Ni44OTM4IDg0Ljc3ODYgODYuOTk1IDgzLjkwMjggODcuMTAwMyA4M0g5OS4wMDU0TDk4LjU5MjQgODYuODA3OUM5Ny44Nzk3IDg2LjgwNzkgOTcuMTE4NCA4Ni44MDc5IDk2LjMwODUgODYuODA3OUM5NS40OTg3IDg2LjgwNzkgOTQuNTQzIDg2LjgwNzkgOTMuNDQxNiA4Ni44MDc5SDg5LjQ5MzVMOTEuODk4OCA4My43NjM5QzkxLjgwMTYgODQuNjU5IDkxLjcwNDQgODUuNTM0NyA5MS42MDcyIDg2LjM5MTJDOTEuNTE4MSA4Ny4yNCA5MS40MTI5IDg4LjIwNDUgOTEuMjkxNCA4OS4yODQ3TDkwLjgyOTggOTMuMzkzNUM5MC43MTY0IDk0LjQzNTIgOTAuNjE1MSA5NS4zNjg4IDkwLjUyNjEgOTYuMTk0NEM5MC40MzcgOTcuMDEyMyA5MC4zNDM4IDk3Ljg1NzMgOTAuMjQ2NiA5OC43MjkyTDg4LjgzNzUgOTUuNjk2OEg5Mi43OTc3QzkzLjcxMjkgOTUuNjk2OCA5NC41NzU0IDk1LjY5NjggOTUuMzg1MyA5NS42OTY4Qzk2LjIwMzMgOTUuNjk2OCA5Ni45OTI5IDk1LjY5NjggOTcuNzU0MiA5NS42OTY4TDk3LjMxNjggOTkuNTA0Nkg4NS4yNTM4Wk04OS43MzY0IDkyLjk0MjFMOTAuMTEzIDg5LjQ4MTVIOTMuMTc0M0M5NC4yMDI5IDg5LjQ4MTUgOTUuMDg1NiA4OS40ODE1IDk1LjgyMjYgODkuNDgxNUM5Ni41Njc3IDg5LjQ4MTUgOTcuMjg0NCA4OS40ODE1IDk3Ljk3MjggODkuNDgxNUw5Ny41ODQxIDkyLjk0MjFDOTYuODU1MiA5Mi45NDIxIDk2LjEyMjMgOTIuOTQyMSA5NS4zODUzIDkyLjk0MjFDOTQuNjU2NCA5Mi45NDIxIDkzLjc4OTggOTIuOTQyMSA5Mi43ODU2IDkyLjk0MjFIODkuNzM2NFoiIGZpbGw9IndoaXRlIi8+DQo8cGF0aCBkPSJNMTA5LjU5IDk5LjUwNDZDMTA5LjI1IDk4LjgxMDIgMTA4LjkzIDk4LjE1ODIgMTA4LjYzIDk3LjU0ODZDMTA4LjMzIDk2LjkzMTMgMTA4LjAzNSA5Ni4zMjE4IDEwNy43NDMgOTUuNzE5OUwxMDYuMjg1IDkyLjc1NjlIMTA1LjIwNEwxMDUuNjA1IDg5LjA1MzJIMTA2LjYxM0wxMDguNDExIDg2LjY4MDZDMTA4Ljg0MSA4Ni4xMTczIDEwOS4yNjYgODUuNTU0IDEwOS42ODcgODQuOTkwN0MxMTAuMTE2IDg0LjQxOTggMTEwLjYxNCA4My43NTYyIDExMS4xODEgODNIMTE3QzExNi4yMzkgODMuODg3MyAxMTUuNDkgODQuNzY3IDExNC43NTMgODUuNjM4OUMxMTQuMDE2IDg2LjUwMzEgMTEzLjI3MSA4Ny4zNzUgMTEyLjUxNyA4OC4yNTQ2TDEwOS42NzUgOTEuNTk5NUwxMDkuNjUgODkuNDkzMUwxMTIuMDA3IDkzLjU5MDNDMTEyLjM3MiA5NC4yMDc2IDExMi43NiA5NC44Nzg5IDExMy4xNzMgOTUuNjA0MkMxMTMuNTk0IDk2LjMyOTUgMTE0LjAwMyA5Ny4wMzU1IDExNC40IDk3LjcyMjJDMTE0Ljc5NyA5OC40MDEyIDExNS4xNDEgOTguOTk1NCAxMTUuNDMzIDk5LjUwNDZIMTA5LjU5Wk05OS43OTgzIDk5LjUwNDZDOTkuODk1NSA5OC42MzI3IDk5Ljk4ODYgOTcuNzg3OCAxMDAuMDc4IDk2Ljk2OTlDMTAwLjE2NyA5Ni4xNTIgMTAwLjI3MiA5NS4yMTg0IDEwMC4zOTQgOTQuMTY5TDEwMS4wMjUgODguNTMyNEMxMDEuMTQ3IDg3LjQ1MjIgMTAxLjI1MiA4Ni40ODc3IDEwMS4zNDEgODUuNjM4OUMxMDEuNDM4IDg0Ljc4MjQgMTAxLjU0IDgzLjkwMjggMTAxLjY0NSA4M0gxMDYuNjM4QzEwNi41NCA4My44OTUxIDEwNi40NDMgODQuNzcwOCAxMDYuMzQ2IDg1LjYyNzNDMTA2LjI0OSA4Ni40ODM4IDEwNi4xNCA4Ny40NTIyIDEwNi4wMTggODguNTMyNEwxMDUuMzk5IDk0LjE1NzRDMTA1LjI3NyA5NS4yMTQ1IDEwNS4xNzIgOTYuMTUyIDEwNS4wODMgOTYuOTY5OUMxMDQuOTk0IDk3Ljc4NzggMTA0Ljg5NiA5OC42MzI3IDEwNC43OTEgOTkuNTA0Nkg5OS43OTgzWiIgZmlsbD0id2hpdGUiLz4NCjxwYXRoIGQ9Ik05Ljk5OTk5IDE2TDIgMjRMMTggNDBMNDIgMTZDMzMuMTYzNCA3LjE2MzQ0IDE4LjgzNjUgNy4xNjM0NSA5Ljk5OTk5IDE2WiIgZmlsbD0id2hpdGUiLz4NCjxwYXRoIG9wYWNpdHk9IjAuNyIgZD0iTTQ2IDEyTDE4IDQwTDM0IDU2TDc4IDEyQzY5LjE2MzQgMy4xNjM0NCA1NC44MzY1IDMuMTYzNDYgNDYgMTJaIiBmaWxsPSJ3aGl0ZSIvPg0KPHBhdGggb3BhY2l0eT0iMC40IiBkPSJNODIgNy45OTk5OEwzNCA1NkM0Mi44MzY2IDY0LjgzNjYgNTcuMTYzNCA2NC44MzY2IDY2IDU2TDExNCA4QzEwNS4xNjMgLTAuODM2NTU3IDkwLjgzNjYgLTAuODM2NTcyIDgyIDcuOTk5OThaIiBmaWxsPSJ3aGl0ZSIvPg0KPC9nPg0KPGRlZnM+DQo8Y2xpcFBhdGggaWQ9ImNsaXAwXzMxOThfMjUwMzciPg0KPHJlY3Qgd2lkdGg9IjExNiIgaGVpZ2h0PSIxMDQiIGZpbGw9IndoaXRlIi8+DQo8L2NsaXBQYXRoPg0KPC9kZWZzPg0KPC9zdmc+DQo='/>
            </div>
        </div>
        <div class="row">&nbsp;</div>
        <div class="row" style="text-align: center;">
            <!-- <a style="background-color: #0163a4; border-color: #041436;  width: 90%;" class="btn btn-lg btn-success" href="/site/svyaznoy">
                        Информация для заемщиков - Связной Банк (АО)</a> -->
            <?php
                echo Button::widget([
                        'label' => 'Информация для заемщиков - Связной Банк (АО)',
                        'options' => [
                            'class' => 'btn-xl btn-info',
                            'style' => 'margin:5px; width:90%; height: 160px;',
                            'onClick' => 'window.location.href = "/site/svyaznoy";'
                        ], // переопределяем стили bootstrap css своими
                        //'tagName' => 'div'
                    ]);
            ?>
        </div>
        <div class="row">&nbsp;</div>
        <div class="row" style="text-align: center;">
            <!-- <a style="background-color: #0163a4; border-color: #041436;  width: 90%; height: 40%;" class="btn btn-lg btn-success" href="/site/trust">
                        Информация для заемщиков - Банк «ТРАСТ» (ПАО)</a> -->
            <?php
                echo Button::widget([
                        'label' => 'Информация для заемщиков - Банк «ТРАСТ» (ПАО)',
                        'options' => [
                            'class' => 'btn-xl btn-info',
                            'style' => 'margin:5px; width:90%; height: 160px; background-color: #0163a4; border-color: #041436;',
                            'onClick' => 'window.location.href = "/site/trust";'
                        ], // переопределяем стили bootstrap css своими
                        //'tagName' => 'div'
                    ]);
            ?>
        </div>
        <div class="row">&nbsp;</div>
        <div class="row" style="text-align: center;">
            <?php
                Modal::begin([
                    'header' => "<h2 style='color: black;'>Уважаемые посетители сайта ООО «СФО ИнвестКредит Финанс»!</h2>",
                    'toggleButton' => [
                        'tag' => 'button',
                        'style' => 'margin-top:5px; /*margin-left: 60px;*/ width:90%;',
                        //'class' => 'btn btn-lg btn-block btn-info',
                        'class' => 'btn-lg btn-info',
                        'label' => 'Информация для посетителей сайта',
                        ],
                ]);

            echo "<span style='color: black;'><p style='text-align: justify;'>Участились случаи мошеннических действий с использованием наименования ООО «СФО ИнвестКредит Финанс». Как правило, мошенники вводят
                в заблуждение потребителей финансовых услуг, предлагая услуги по оказанию содействия в получении кредитов под поручительство
                ООО «СФО ИнвестКредит Финанс», и просят перечислить денежные средства в качестве подтверждения платежеспособности клиента.
                В подтверждение своих полномочий мошенники направляют сфальсифицированные копии договоров.</p>

                <p style='text-align: justify;'>В свою очередь, ООО «СФО ИнвестКредит Финанс» заявляет, что не оказывает никаких услуг физическим и юридическим лицам и не
                    сотрудничает с кредитными организациями по вопросам кредитования.</p>
                <p style='text-align: justify;'>В случае необходимости, по факту мошенничества Вам следует обращаться в правоохранительные органы с заявлением о преступлении в
                    рамках законодательства Российской Федерации.</p></span>";

                Modal::end();
            ?>
        </div>
    </div>
</div>
