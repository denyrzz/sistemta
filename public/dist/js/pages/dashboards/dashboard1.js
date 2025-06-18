$(document).ready(function() {
    // Initialize jQuery UI tooltips if the tooltip method is available
    if ($.fn.tooltip) {
        $('[data-toggle="tooltip"]').tooltip();  // Initialize tooltips for elements with the attribute 'data-toggle="tooltip"'
    }

    // Initialize Chartist chart with tooltip plugin
    if (typeof Chartist !== 'undefined') {  // Check if Chartist is loaded
        var data = {
            // Your chart data here (e.g., series, labels)
        };
        var options = {
            // Your chart options here
        };

        new Chartist.Line('.ct-chart', data, options).on('draw', function(event) {
            // Add tooltip data for points
            if (event.type === 'point') {
                event.element.attr({
                    'data-tooltip': event.value.y  // Set the tooltip data to the y value of the point
                });
            }
        });
    } else {
        console.error('Chartist is not loaded. Please ensure Chartist.js is included before this script.');
    }
});
