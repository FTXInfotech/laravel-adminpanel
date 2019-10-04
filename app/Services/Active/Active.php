<?php

namespace App\Services\Active;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Str;

/**
 * Return "active" class for the current route if needed.
 *
 * Check the current route to decide whether return an "active" class base on:
 * <ul>
 *   <li>current route URI</li>
 *   <li>current route name</li>
 *   <li>current action</li>
 *   <li>current controller</li>
 * </ul>
 *
 * @author     Hieu Le <letrunghieu.cse09@gmail.com>
 *
 * @version    3.2.0
 *
 */
class Active
{
    /**
     * Current request.
     *
     * @var Request
     */
    protected $request;
    /**
     * Current matched route.
     *
     * @var Route
     */
    protected $route;
    /**
     * Current action string.
     *
     * @var string
     */
    protected $action;
    /**
     * Current controller class.
     *
     * @var string
     */
    protected $controller;
    /**
     * Current controller method.
     *
     * @var string
     */
    protected $method;
    /**
     * Current URI.
     *
     * @var string
     */
    protected $uri;
    /**
     * Active constructor.
     *
     * @param Request $request current request instance
     */
    public function __construct($request)
    {
        $this->updateInstances(null, $request);
    }
    /**
     * Update the route and request instances.
     *
     * @param Route   $route
     * @param Request $request
     */
    public function updateInstances($route, $request)
    {
        $this->request = $request;
        if ($request) {
            $this->uri = urldecode($request->path());
        }
        $this->route = $route;
        if ($route) {
            $this->action = $route->getActionName();
            $actionSegments = Str::parseCallback($this->action, null);
            $this->controller = head($actionSegments);
            $this->method = last($actionSegments);
        }
    }
    /**
     * Get the active class if the condition is not falsy.
     *
     * @param        $condition
     * @param string $activeClass
     * @param string $inactiveClass
     *
     * @return string
     */
    public function getClassIf($condition, $activeClass = 'active', $inactiveClass = '')
    {
        return $condition ? $activeClass : $inactiveClass;
    }
    /**
     * Check if the URI of the current request matches one of the specific URIs.
     *
     * @param array|string $uris
     *
     * @return bool
     */
    public function checkUri($uris)
    {
        if (!$this->request) {
            return false;
        }
        foreach ((array)$uris as $uri) {
            if ($this->uri == $uri) {
                return true;
            }
        }
        return false;
    }
    /**
     * Check if the current URI matches one of specific patterns (using `Str::is`).
     *
     * @param array|string $patterns
     *
     * @return bool
     */
    public function checkUriPattern($patterns)
    {
        if (!$this->request) {
            return false;
        }
        foreach ((array) $patterns as $p) {
            if (Str::is($p, $this->uri)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Check if one of the following condition is true:
     * + the value of $value is `false` and the current querystring contain the key $key
     * + the value of $value is not `false` and the current value of the $key key in the querystring equals to $value
     * + the value of $value is not `false` and the current value of the $key key in the querystring is an array that
     * contains the $value.
     *
     * @param string $key
     * @param mixed  $value
     *
     * @return bool
     */
    public function checkQuery($key, $value)
    {
        if (!$this->request) {
            return false;
        }
        $queryValue = $this->request->query($key);
        // if the `key` exists in the query string with the correct value
        // OR it exists with any value
        // OR its value is an array that contains the specific value
        if (($queryValue == $value) || ($queryValue !== null && $value === false) || (is_array($queryValue) && in_array(
            $value,
            $queryValue
        ))
        ) {
            return true;
        }
        return false;
    }
    /**
     * Check if the name of the current route matches one of specific values.
     *
     * @param array|string $routeNames
     *
     * @return bool
     */
    public function checkRoute($routeNames)
    {
        if (!$this->route) {
            return false;
        }
        $routeName = $this->route->getName();
        if (in_array($routeName, (array) $routeNames)) {
            return true;
        }
        return false;
    }
    /**
     * Check the current route name with one or some patterns.
     *
     * @param array|string $patterns
     *
     * @return bool
     */
    public function checkRoutePattern($patterns)
    {
        if (!$this->route) {
            return false;
        }
        $routeName = $this->route->getName();
        if ($routeName == null) {
            return in_array(null, $patterns);
        }
        foreach ((array) $patterns as $p) {
            if (Str::is($p, $routeName)) {
                return true;
            }
        }
        return false;
    }
    /**
     * Check if the parameter of the current route has the correct value.
     *
     * @param $param
     * @param $value
     *
     * @return bool
     */
    public function checkRouteParam($param, $value)
    {
        if (!$this->route) {
            return false;
        }
        $paramValue = $this->route->parameter($param);
        // If the parameter value is an instance of Model class, we compare $value with the value of
        // its primary key.
        if (is_a($paramValue, Model::class)) {
            return $paramValue->{$paramValue->getKeyName()} == $value;
        }
        return $paramValue == $value;
    }
    /**
     * Return 'active' class if current route action match one of provided action names.
     *
     * @param array|string $actions
     *
     * @return bool
     */
    public function checkAction($actions)
    {
        if (!$this->action) {
            return false;
        }
        if (in_array($this->action, (array)$actions)) {
            return true;
        }
        return false;
    }
    /**
     * Check if the current controller class matches one of specific values.
     *
     * @param array|string $controllers
     *
     * @return bool
     */
    public function checkController($controllers)
    {
        if (!$this->controller) {
            return false;
        }
        if (in_array($this->controller, (array)$controllers)) {
            return true;
        }
        return false;
    }
    /**
     * Get the current controller method.
     *
     * @return string
     */
    public function getMethod()
    {
        return $this->method ?: '';
    }
    /**
     * Get the current action string.
     *
     * @return string
     */
    public function getAction()
    {
        return $this->action ?: '';
    }
    /**
     * Get the current controller class.
     *
     * @return string
     */
    public function getController()
    {
        return $this->controller ?: '';
    }
}