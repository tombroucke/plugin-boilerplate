<?php

namespace Otomaties\PluginBoilerplate\Helpers;

use Illuminate\Support\Collection;



class Loader
{
    protected $actions;

    protected $filters;

    public function __construct()
    {
        $this->actions = collect();
        $this->filters = collect();
    }

    public function addAction($hook, $component, $callback, $priority = 10, $accepted_args = 1) : void
    {
        $this->actions = $this->add($this->actions, $hook, $component, $callback, $priority, $accepted_args);
    }

    public function removeAction($hook, $component, $callback)
    {
        $this->actions = $this->remove($this->actions, $hook, $component, $callback);
    }

    public function addFilter($hook, $component, $callback, $priority = 10, $accepted_args = 1) : void
    {
        $this->filters = $this->add($this->filters, $hook, $component, $callback, $priority, $accepted_args);
    }

    public function removeFilter($hook, $component, $callback)
    {
        $this->filters = $this->remove($this->filters, $hook, $component, $callback);
    }

    private function add($hooks, $hook, $component, $callback, $priority, $accepted_args) : Collection
    {
        $hooks->push([
            'hook'          => $hook,
            'component'     => $component,
            'callback'      => $callback,
            'priority'      => $priority,
            'accepted_args' => $accepted_args
        ]);

        return $hooks;
    }

    private function remove($hooks, $hook, $component, $callback) : Collection
    {
        $hooks = $hooks->reject(function ($item) use ($hook, $component, $callback) {
            return $item['hook'] === $hook
                && $item['component'] === $component
                && $item['callback'] === $callback;
        });

        return $hooks;
    }

    public function run() : void
    {
        $this->filters->each(function ($filter) {
            add_filter(
                $filter['hook'],
                array( $filter['component'],
                $filter['callback'] ),
                $filter['priority'],
                $filter['accepted_args']
            );
        });

        $this->actions->each(function ($action) {
            add_action(
                $action['hook'],
                array( $action['component'],
                $action['callback'] ),
                $action['priority'],
                $action['accepted_args']
            );
        });
    }
}
