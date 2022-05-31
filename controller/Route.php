<?php

namespace Controller;

class Route
{
    /*
     * Метод chekUri проверяет соответствует ли текущая страница заданной странице в аргументе
     */
    private function checkUri($uri)
    {
        $curUri = $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
        if ($uri[0] == "/") $uri = substr($uri, 1);
        $uri = $_SERVER["SERVER_NAME"] . "/{$uri}";
        if ($curUri == $uri) {
            return true;
        } else {
            return false;
        }
    }

    /*
     * Функция renderView() подключает файл из папки view.
     * Аргумент задается без расширения .php
     * Например, renderView("test")
     */
    private function renderView($view)
    {
        require_once "../view/{$view}.php";
    }

    /*
     * Статические методы get и post класса Route призваны сравнить, какой метод используется.
     * Затем вызывают по цепочке метод checkUri для проверки соответствия текущего адресса заданному адресу страницы.
     * Затем вызывается метод отображения указанного файла renderView()
     */
    public static function get($uri, $view)
    {
        if ($_SERVER["REQUEST_METHOD"] !== "GET") {
            return;
        }
        $route = new Route;
        $res = $route->checkUri($uri);
        if ($res) $route->renderView($view);
    }

    public static function post($uri, $view)
    {
        if ($_SERVER["REQUEST_METHOD"] !== "POST") {
            return;
        }
        $route = new Route;
        $res = $route->checkUri($uri);
        if ($res) $route->renderView($view);
    }

}
