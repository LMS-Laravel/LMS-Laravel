/**
 * @author      José Lorente <jose.lorente.martin@gmail.com>
 * @license     The MIT License (MIT)
 * @copyright   José Lorente
 * @version     1.0
 */

/**
 * 
 * @param jQuery $
 * @param document document
 * @param undefined undefined
 */
(function ($, d, u) {
    var rFunction = function (options) {
        var defaults = {
            label: {
                tag: 'p',
                id: null,
                class: 'char-counter',
                invalidClass: 'error'
            },
            text: '{n}'
        };
        var options = $.extend(defaults, options);
        return this.each(function () {
            var $label = $(d.createElement(options.label.tag));
            var $_this = $(this);
            var max = $_this.attr("maxlength");
            var update = function (c) {
                var r = max - c;
                $label.text(options.text.replace('{n}', r));
                $label.toggleClass(options.label.invalidClass, r < 0);
            };
            var identifier;

            if (max === u) {
                throw "jQuery RemainingCharacters: Couldn't find maxlength attribute on attached element"
            }
            if (options.label.class !== null) {
                $label.addClass(options.label.class);
                identifier = '.' + options.label.class;
            }
            if (options.label.id !== null) {
                $label.attr('id', options.label.id);
                identifier = '#' + options.label.id;
            }
            if ($_this.next(identifier).length > 0) {
                return;
            }
            $label.text(max);
            $_this.after($label);
            update($_this.val().length);
            $_this.on('keyup', function () {
                update($(this).val().length);
            });
        });
    };

    /**
     * Exports
     */
    $.fn.remainingCharacters = rFunction;
})(jQuery, document, undefined);