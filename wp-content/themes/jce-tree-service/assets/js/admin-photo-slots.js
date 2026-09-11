/**
 * Photo slots panel — pairs one image with each line of a companion
 * textarea (e.g. "The List" on a Service). See jce_field_photo_slots() in
 * inc/fields.php.
 */
( function ( $ ) {
	'use strict';

	function parseTitles( text ) {
		return ( text || '' )
			.split( /\r?\n/ )
			.map( function ( line ) {
				return line.trim();
			} )
			.filter( Boolean )
			.map( function ( line ) {
				return line.split( '|' )[ 0 ].trim();
			} );
	}

	function parseIds( value ) {
		return ( value || '' ).split( ',' ).map( function ( id ) {
			return id.trim();
		} );
	}

	function thumbUrl( attachment ) {
		return ( attachment.sizes && attachment.sizes.thumbnail && attachment.sizes.thumbnail.url ) || attachment.url;
	}

	function setThumb( $row, id ) {
		var $thumb = $row.find( '.jce-photo-slot__thumb' ).empty();
		var $remove = $row.find( '.jce-photo-slot__remove' );

		if ( ! id ) {
			$remove.hide();
			return;
		}

		$remove.show();
		wp.media.attachment( id ).fetch().done( function () {
			var attachment = wp.media.attachment( id ).toJSON();
			$thumb.html( $( '<img>' ).attr( 'src', thumbUrl( attachment ) ) );
		} );
	}

	function writeValue( $panel ) {
		var ids = $panel
			.find( '.jce-photo-slot' )
			.map( function () {
				return $( this ).attr( 'data-id' ) || '';
			} )
			.get();
		$panel.find( '.jce-photo-slots__value' ).val( ids.join( ',' ) );
	}

	function render( $panel ) {
		var $source = $( '#' + $panel.data( 'source' ) );
		var titles = parseTitles( $source.val() );
		var ids = parseIds( $panel.find( '.jce-photo-slots__value' ).val() );
		var $rows = $panel.find( '.jce-photo-slots__rows' ).empty();

		titles.forEach( function ( title, index ) {
			var id = ids[ index ] || '';
			var $row = $( '<div class="jce-photo-slot"></div>' ).attr( 'data-id', id );

			$row.append( $( '<div class="jce-photo-slot__thumb"></div>' ) );
			$row.append( $( '<span class="jce-photo-slot__title"></span>' ).text( title ) );
			$row.append( $( '<button type="button" class="button jce-photo-slot__choose">Choose Image</button>' ) );
			$row.append( $( '<button type="button" class="button-link jce-photo-slot__remove">Remove</button>' ).hide() );

			$rows.append( $row );
			setThumb( $row, id );
		} );

		writeValue( $panel );
	}

	$( function () {
		$( '.jce-photo-slots' ).each( function () {
			render( $( this ) );
		} );

		$( document ).on( 'click', '.jce-photo-slots__sync', function ( e ) {
			e.preventDefault();
			render( $( this ).closest( '.jce-photo-slots' ) );
		} );

		$( document ).on( 'click', '.jce-photo-slot__choose', function ( e ) {
			e.preventDefault();

			var $row = $( this ).closest( '.jce-photo-slot' );
			var $panel = $row.closest( '.jce-photo-slots' );
			var frame = wp.media( { title: 'Select Photo', multiple: false, library: { type: 'image' } } );

			frame.on( 'select', function () {
				var attachment = frame.state().get( 'selection' ).first().toJSON();
				$row.attr( 'data-id', attachment.id );
				$row.find( '.jce-photo-slot__thumb' ).html( $( '<img>' ).attr( 'src', thumbUrl( attachment ) ) );
				$row.find( '.jce-photo-slot__remove' ).show();
				writeValue( $panel );
			} );

			frame.open();
		} );

		$( document ).on( 'click', '.jce-photo-slot__remove', function ( e ) {
			e.preventDefault();

			var $row = $( this ).closest( '.jce-photo-slot' );
			var $panel = $row.closest( '.jce-photo-slots' );

			$row.attr( 'data-id', '' );
			$row.find( '.jce-photo-slot__thumb' ).empty();
			$( this ).hide();
			writeValue( $panel );
		} );
	} );

	/**
	 * Single-image picker — one thumbnail, no companion list to match
	 * against. See jce_field_image() in inc/fields.php.
	 */
	$( function () {
		$( document ).on( 'click', '.jce-image-field__choose', function ( e ) {
			e.preventDefault();

			var $field = $( this ).closest( '.jce-image-field' );
			var frame = wp.media( { title: 'Select Image', multiple: false, library: { type: 'image' } } );

			frame.on( 'select', function () {
				var attachment = frame.state().get( 'selection' ).first().toJSON();
				$field.attr( 'data-value', attachment.id );
				$field.find( '.jce-image-field__thumb' ).html( $( '<img>' ).attr( 'src', thumbUrl( attachment ) ) );
				$field.find( '.jce-image-field__value' ).val( attachment.id );
				$field.find( '.jce-image-field__remove' ).show();
			} );

			frame.open();
		} );

		$( document ).on( 'click', '.jce-image-field__remove', function ( e ) {
			e.preventDefault();

			var $field = $( this ).closest( '.jce-image-field' );
			$field.attr( 'data-value', '' );
			$field.find( '.jce-image-field__thumb' ).empty();
			$field.find( '.jce-image-field__value' ).val( '' );
			$( this ).hide();
		} );
	} );
} )( jQuery );
