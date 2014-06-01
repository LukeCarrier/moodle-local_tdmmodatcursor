// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * TDM: Insert module at cursor.
 *
 * @package   local_tdmmodatcursor
 * @author    Luke Carrier <luke@tdm.co>
 * @copyright (c) 2014 The Development Manager Ltd
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

var NS = Y.namespace('M.local_tdmmodatcursor.modatcursor');

/*global M */

/**
 * Format a string.
 *
 * @param string   string       The string to perform the replacements upon.
 * @param string[] replacements An array of string => replacement parameters, where indexes correspond with curly brace
 *                              ({) enclosed placeholders.
 *
 * @return string The formatted string.
 */
NS.formatString = function(string, replacements) {
    Y.Object.each(replacements, function(value, parameter) {
        string = string.replace('{' + parameter + '}', value);
    });

    return string;
};

/**
 * Handle an event.
 *
 * @param DOMFacade e A YUI DOM facade object.
 *
 * @return void
 */
NS.handleEvent = function(e) {
    var element = e.currentTarget,
        type    = e.type;

    switch (type) {
        case 'mouseover':
            this.showButtons(element);
            break;

        case 'mouseout':
            if (e.relatedTarget && e.relatedTarget.get('id').substr(0, 8) === 'section-') {
                this.hideButtons();
            }
            break;
    }
};

/**
 * Hide buttons for all activities.
 *
 * @return void
 */
NS.hideButtons = function() {
    this.top.all('.' + this.params.listItemClass).remove(true);
};

/**
 * Initialise the module.
 *
 * @param mixed params The parameters to initialise the object from. For documentation, see the defaultParams variable
 *                     contained within the method.
 *
 * @return void
 */
NS.init = function(params) {
    var defaultParams = {
        course:           null,
        activitySelector: '.activity',
        sectionSelector:  '.section',
        topElement:       '.course-content',
        baseUrl:          '/local/tdmmodatcursor/index.php?add={mod}&course={course}&section={section}&addabove={addabove}',
        buttonClass:      'modatcursor-button',
        listItemClass:    'modatcursor-listitem',
        modules:          {}
    };

    this.params = Y.merge(defaultParams, params);
    this.top    = Y.one(this.params.topElement);

    if (!Y.one('body').hasClass('editing')) {
        return;
    }

    if (this.params.course === null) {
        throw 'Course ID must be specified';
    }

    this.setupHandlers();
};

/**
 * Initialise event handlers
 *
 * @return void
 */
NS.setupHandlers = function() {
    this.top.delegate('mouseover', this.handleEvent, this.params.activitySelector, this);
    this.top.delegate('mouseout',  this.handleEvent, this.params.sectionSelector,  this);
};

/**
 * Show buttons for a given activity.
 *
 * @param Node activityElement A YUI node object representing the element which triggered our execution.
 *
 * @return void
 */
NS.showButtons = function(activityElement) {
    if (activityElement.one('.' + this.params.listItemClass) !== null) {
        return;
    }

    this.hideButtons();

    var buttonContainer = activityElement.one('.menubar'),
        addAbove        = activityElement.get('id').substr(7),
        section         = activityElement.ancestor('.section').ancestor('.section').get('id').substr(8);

    Y.Object.each(this.params.modules, function(name, mod) {
        var button, url, listItem;

        url = M.cfg.wwwroot + this.formatString(this.params.baseUrl, {
            addabove: addAbove,
            course:   this.params.course,
            section:  section,
            mod:     mod
        });

        button   = Y.Node.create('<a href="' + url + '">' + M.util.get_string('addmod', 'local_tdmmodatcursor', name)
                                 + '</a>');
        listItem = Y.Node.create('<li></li>');

        button.set('data-section', section);
        button.addClass(this.params.buttonClass);

        listItem.addClass(this.params.listItemClass);

        listItem.append(button);
        buttonContainer.prepend(listItem);
    }, this);
};
