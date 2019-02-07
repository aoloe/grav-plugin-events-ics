<?php
namespace Grav\Plugin;

use Grav\Common\Plugin;
use Grav\Common\Page\Page;
use RocketTheme\Toolbox\Event\Event;

/**
 * Class EventsIcsPlugin
 * @package Grav\Plugin
 */
class EventsIcsPlugin extends Plugin
{

    private $calendar = [];
    private $default = [
        'name' => 'Trainings beim BC-Oberurdorf',
        'description' => 'Trainings beim BC-Oberurdorf',
    ];

    public static function getSubscribedEvents()
    {
        return [
            'onPluginsInitialized' => ['onPluginsInitialized', 0]
        ];
    }

    /**
     * process only if the current path matches the one defined
     * in the plugin's configuraiton.
     */
    public function onPluginsInitialized()
    {
        if ($this->isAdmin()) {
            return;
        }

        $uri = $this->grav['uri'];
        $route = $this->config->get('plugins.events-ics.route');

        if ($route && $route == $uri->path()) {
            $this->enable([
                'onTwigTemplatePaths' => ['onTwigTemplatePaths', 0],
                'onPageInitialized' => ['onPageInitialized', 0],
                'onTwigSiteVariables' => ['onTwigSiteVariables', 0],
                'onOutputGenerated' => ['onOutputGenerated', 0],
            ]);
        }
    }

    public function onTwigTemplatePaths()
    {
        $this->grav['twig']->twig_paths[] = __DIR__ . '/templates';
    }

    public function onPageInitialized()
    {
        $this->calendar = $this->default;

        $page = new Page;
        $page->init(new \SplFileInfo(__DIR__ . '/pages/events.md'));
        unset($this->grav['page']);
        $this->grav['page'] = $page;
    }


    public function onTwigSiteVariables()
    {
        $twig = $this->grav['twig'];
        $twig->twig_vars['calendar'] = $this->calendar;
    }

    /**
     * Set the "right" end of lines.
     */
    public function onOutputGenerated() {
        $this->grav->output = str_replace("\n", "\r\n", $this->grav->output);
    }

    static public function getIcsDateFromIso($isodate = null) {
      return gmdate('Ymd\THis\Z', isset($isodate) ? strtotime($isodate) : time());
    }

    static public function getIcsStringEscaped($string = null) {
      return preg_replace('/([\,;])/','\\\$1', $string);
    }

}
