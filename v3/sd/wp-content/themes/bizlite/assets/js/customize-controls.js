( function( api ) {

	// Extends our custom "fino" section.
	api.sectionConstructor['bizlite'] = api.Section.extend( {

		// No events for this type of section.
		attachEvents: function () {},

		// Always make the section active.
		isContextuallyActive: function () {
			return true;
		}
	} );

} )( wp.customize );
