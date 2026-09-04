<?php
/**
 * Services landing page (/services/).
 *
 * The hub every individual service page links back up to. Order of the grid
 * comes from each Service's Page Attributes > Order, so removal leads.
 *
 * The intro copy and the "how we decide" points below the grid are editable in
 * WordPress: create a Page with the slug "services-intro" and this template
 * pulls its content and Highlight Cards field. Until then, the example copy
 * here stands in so the layout reads finished.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

jce_band( 'dark' ); // The hero is a dark band — start the alternation on white.

// Optional companion Page, so the editorial copy on this archive is editable
// in WordPress. Archives have no post of their own to hold it.
$intro_page = get_page_by_path( 'services-intro' );

$intro_title = __( 'Tree Services in River Falls, Hudson &amp; Prescott', 'jce' );
$intro_sub   = __( 'Removal is about two-thirds of what we do. The rest is keeping the trees worth keeping healthy — and telling you honestly which is which.', 'jce' );

get_template_part(
	'template-parts/page-hero',
	null,
	array(
		'context' => 'services',
		'eyebrow' => __( 'Tree Care Services', 'jce' ),
		'title'   => $intro_page ? get_the_title( $intro_page ) : $intro_title,
		'sub'     => $intro_page && $intro_page->post_excerpt ? $intro_page->post_excerpt : $intro_sub,
	)
);
?>

<section class="section <?php echo esc_attr( jce_band() ); ?>">
	<div class="wrap wrap--narrow entry-content">
		<?php if ( $intro_page && trim( $intro_page->post_content ) ) : ?>
			<?php echo apply_filters( 'the_content', $intro_page->post_content ); // phpcs:ignore WordPress.Security.EscapeOutput -- filtered post content. ?>
		<?php else : ?>
			<h2 class="mt-0"><?php esc_html_e( 'One crew, trained for the whole list.', 'jce' ); ?></h2>
			<p><?php esc_html_e( 'Most homeowners find us because something needs to come down. A dead ash, a silver maple dropping limbs on the driveway, an oak that started leaning after the last storm. That is the bulk of our work and the reason the equipment in our yard looks the way it does.', 'jce' ); ?></p>
			<p><?php esc_html_e( 'But an ISA-certified arborist walking your property is going to notice the rest of it too, and we would rather tell you what we see than sell you the one job you called about. Sometimes that means a tree you assumed was finished can be pruned back into shape for a fraction of a removal. Sometimes it means the tree you were not worried about is the one with a problem.', 'jce' ); ?></p>
			<p><?php esc_html_e( 'Either way you get the assessment first and the number second. Below is everything we are set up to do — pick the one you came for, or call and describe what you are looking at.', 'jce' ); ?></p>
		<?php endif; ?>
	</div>
</section>

<?php
get_template_part(
	'template-parts/services-grid',
	null,
	array(
		'heading' => __( 'Every Service We Offer', 'jce' ),
		'eyebrow' => __( 'The Full List', 'jce' ),
		'lede'    => __( 'Eight services, one crew, and the same arborist assessment behind every one of them.', 'jce' ),
		'class'   => jce_band(),
	)
);

// "How we decide" — editable via the Highlight Cards field on the
// services-intro Page, with example copy as the fallback.
$decide_rows = $intro_page ? jce_field_rows( '_jce_page_highlights', 2, $intro_page->ID ) : array();
if ( ! $decide_rows ) {
	$decide_rows = array(
		array( __( 'Save it if it can be saved', 'jce' ), __( 'A tree with a dead limb is not a dead tree. If pruning buys you another twenty years, that is the recommendation you get, even though it is the smaller invoice.', 'jce' ) ),
		array( __( 'Take it down before it comes down', 'jce' ), __( 'A leaning trunk over a bedroom is not a wait-and-see. We will tell you plainly when something has moved from a maintenance question to a safety one.', 'jce' ) ),
		array( __( 'Time it to the species', 'jce' ), __( 'Oaks get pruned in the dormant season because of oak wilt. Ash gets treated before the beetle is visible, not after. The calendar is part of the recommendation.', 'jce' ) ),
		array( __( 'Leave the yard right', 'jce' ), __( 'Every piece of equipment we own was chosen to spread weight and protect turf. Cleanup is part of the job, not a line item on top of it.', 'jce' ) ),
	);
}

get_template_part(
	'template-parts/highlight-cards',
	null,
	array(
		'rows'    => $decide_rows,
		'icons'   => array( 'leaf', 'shield', 'calendar', 'truck' ),
		'eyebrow' => __( 'How We Decide', 'jce' ),
		'heading' => __( 'What an Arborist Weighs Before Quoting', 'jce' ),
		'lede'    => __( 'The same four questions get asked on every property we walk, whatever service brought us there.', 'jce' ),
		'class'   => jce_band(),
	)
);

get_template_part( 'template-parts/credentials' );
jce_band( 'dark' );
get_template_part( 'template-parts/personal-estimate-steps', null, array( 'class' => jce_band() ) );

$faq_rows = $intro_page ? jce_field_rows( '_jce_page_faq', 2, $intro_page->ID ) : array();
if ( ! $faq_rows ) {
	$faq_rows = array(
		array( __( 'Do you charge for an estimate?', 'jce' ), __( 'No. An arborist comes out, walks the property, and hand-writes the estimate while standing there with you. There is no fee and no obligation attached to it.', 'jce' ) ),
		array( __( 'How far ahead are you booking?', 'jce' ), __( 'Routine removals and pruning are usually two to four weeks out, longer in the fall rush. Storm damage and anything resting on a structure jumps the queue the same day.', 'jce' ) ),
		array( __( 'Are you insured?', 'jce' ), __( 'Fully licensed and insured for both liability and workers compensation, and we will hand you the certificate before we start. Ask every company you call for this — an uninsured crew in your tree is your liability, not theirs.', 'jce' ) ),
		array( __( 'Do you haul everything away?', 'jce' ), __( 'Yes, unless you want the wood. Plenty of customers keep the rounds for firewood, and we will stack them wherever you want them at no extra charge. Brush and chips leave with us either way.', 'jce' ) ),
		array( __( 'Will you work with my insurance company?', 'jce' ), __( 'On storm damage, yes. You get photographs and a written description of the damage and the work in the format adjusters actually accept.', 'jce' ) ),
	);
}

get_template_part(
	'template-parts/faq',
	null,
	array(
		'rows'    => $faq_rows,
		'heading' => __( 'Before You Call', 'jce' ),
		'class'   => jce_band(),
	)
);

get_template_part( 'template-parts/service-area', null, array( 'class' => jce_band() ) );
get_template_part( 'template-parts/reviews', null, array( 'class' => jce_band() ) );
get_template_part( 'template-parts/cta-band' );

get_footer();
