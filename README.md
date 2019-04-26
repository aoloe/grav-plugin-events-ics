# Events Ics Plugin

Produce an ICS / iCal file for a list of events.

Currently, this plugin is too tightly integrated with the [Events Schedule](https://github.com/aoloe/grav-plugin-events-schedule) plugin. (Pull) Requests for separating them are welcome.

The **Events Ics** Plugin is for [Grav CMS](http://github.com/getgrav/grav). It publishes events as an ICS file

## Status

This plugin is not yet in production and it still contains code that is tightly bound to the project that first needed it.

It contains very little code and it should be easy for other users to fork it and adapt to their needs or, even better, make pull requests to make it more configurable.

There are issues in the Github issue tracker that hint to the code that needs to be made more _flexible_.

## Installation

Installing the Events Ics plugin can be done in one of two ways. ~~The GPM (Grav Package Manager) installation method enables you to quickly and easily install the plugin with a simple terminal command~~, while the manual method enables you to do so via a zip file.

Currently, you need to first install the [Events Schedule Plugin](https://github.com/aoloe/grav-plugin-events-schedule).

### ~~GPM Installation (Preferred)~~

~~The simplest way to install this plugin is via the [Grav Package Manager (GPM)](http://learn.getgrav.org/advanced/grav-gpm) through your system's terminal (also called the command line).  From the root of your Grav install type:~~

    bin/gpm install events-ics

~~This will install the Events Ics plugin into your `/user/plugins` directory within Grav. Its files can be found under `/your/site/grav/user/plugins/events-ics`.~~

### Manual Installation

To install this plugin, just download the zip version of this repository and unzip it under `/your/site/grav/user/plugins`. Then, rename the folder to `events-ics`. You can find these files on [GitHub](https://github.com/aoloe/grav-plugin-events-ics) or via [GetGrav.org](http://getgrav.org/downloads/plugins#extras).

You should now have all the plugin files under

    /your/site/grav/user/plugins/events-ics
	
> NOTE: This plugin is a modular component for Grav which requires [Grav](http://github.com/getgrav/grav) and the [Error](https://github.com/getgrav/grav-plugin-error) and [Problems](https://github.com/getgrav/grav-plugin-problems) to operate.

### Admin Plugin

If you use the admin plugin, you can install directly through the admin plugin by browsing the `Plugins` tab and clicking on the `Add` button.

## Configuration

Before configuring this plugin, you should copy the `user/plugins/events-ics/events-ics.yaml` to `user/config/plugins/events-ics.yaml` and only edit that copy.

Here is the default configuration and an explanation of available options:

```yaml
enabled: true
route: /calendar.ics
```

Note that if you use the admin plugin, a file with your configuration, and named events-ics.yaml will be saved in the `user/config/plugins/` folder once the configuration is saved in the admin.

## Notes

- How to serve other content types: <https://learn.getgrav.org/content/content-types#other-content-types>
- <https://github.com/getgrav/grav-plugin-simplesearch#config-options> is mentioned for plugin routing.
- <https://github.com/getgrav/grav-plugin-sitemap/blob/develop/sitemap.php#L40-L51> shows changes to be done to the plugin's `.php` file.
- use the `onTwigTemplatePaths` event to add the plugin's template path to the twig's ones.
- `onPageInitialized()` needs to set `$this->grav['page'] = $page;` to avoid a 404.

## To Do

- [ ] For now, only one ICS file per site. <https://github.com/getgrav/grav-plugin-simplesearch/> seems to support page based custom page types (by getting setup in `onPagesInitialized()`, instead of `onPluginsInitialized()`.
