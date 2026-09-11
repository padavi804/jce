<?php
/**
 * One-click example content.
 *
 * Tools > JCE Example Content creates the Services, Locations, Testimonials,
 * and Pages this theme's templates are built around, each one filled with
 * realistic placeholder copy in the WordPress editor and the section fields.
 *
 * The point is that the copy lands in WordPress rather than in PHP: the client
 * sees a finished site on day one and edits it in the editor like any other
 * content, instead of asking a developer to change a template.
 *
 * Safe to run more than once — anything whose slug already exists is skipped,
 * so an import never overwrites edited copy, unless the admin screen's
 * "Replace" box for that specific post type is checked. That replace toggle
 * is per post type (Services / Locations / Pages / Testimonials), not
 * global, so pushing updated copy for Pages can never touch Services, and
 * vice versa — see jce_run_demo_import().
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Wrap paragraphs of plain text as editor content.
 *
 * @param string[] $paragraphs
 */
function jce_demo_body( $paragraphs ) {
	return implode( "\n\n", $paragraphs );
}

/* ---------------------------------------------------------------
 * Services
 * ------------------------------------------------------------- */
function jce_demo_services() {
	return array(
		// APPROVED COPY — signed off by the client. Unlike the other seven
		// services below, none of this is placeholder text: do not rewrite it,
		// and note the dashes switching off the three sections this page has no
		// approved copy for.
		array(
			'slug'    => 'tree-removal',
			'title'   => 'Tree Removal',
			'order'   => 1,
			'excerpt' => "A dead or hazardous tree isn't something to gamble on. Our arborists don't just take trees down, they know when a tree can be saved and when it can't, and they've got 25 years of judgment behind that call.",
			'body'    => '',
			'meta'    => array(
				'_jce_service_eyebrow'       => 'Tree Removal Near Me',
				'_jce_service_headline'      => 'Tree Removal by Local Tree Experts in the St. Croix River Valley',

				// Steps and heading come from the site-wide Customizer default
				// (Business Info > The Personal Estimate) — the same approved five
				// steps every other service page uses. Fill this Service's own
				// "Process Steps" field only to override them for this page.

				'_jce_service_proof'         => "A removal on a tight lot||The JCE Tree Service Team did a great job removing two very large poplars and trimming two others. They have the right equipment to take down big trees in a small area with virtually no property disturbance. I was impressed with their efficiency, professional work, and area clean-up.|Brian Gresback|Before, from the driveway // After, same angle\nRemoving the Tree Without Damaging the Property|Having the right equipment means the tree comes down without putting the rest of your property at risk. Whether that's your pool, your siding, a fence line, a garden, or landscaping you've spent years on, we plan around it before the work starts. A yard can take real damage from the wrong equipment, or work done at the wrong time of year, which is exactly why JCE has spent 25 years investing in the gear to avoid it.|Very friendly, competent, and careful. No lawn damage, and great clean-up afterwards.|Ed, on a dead oak removal|Mats or plywood laid down, drop-zone set up",

				'_jce_service_sub_heading'   => 'Tree Removal Services',
				'_jce_service_sub_intro'     => "Not every tree removal is the same. Some are straightforward. Others require careful planning, specialized equipment and experienced crews to protect your home, property and surrounding trees.\nJCE handles tree removals of all sizes, including complex jobs that require advanced equipment and technical expertise.",
				'_jce_service_note_intro'    => 'Every removal includes full cleanup and haul-away of brush and debris. A few things that are handled separately, so there are no surprises on your estimate:',
				'_jce_service_notes'         => "Stump grinding is available as an add-on.|If you'd like the stump ground down too, just mention it during your estimate and we'll include it in your quote.\nWant to keep the wood? Just ask.|We're happy to chip it into woodchips or cut it into rounds and leave it on-site as firewood instead of hauling it away.",
				'_jce_service_subservices'   => "Standard Tree Removal|When a tree needs to come down and there's adequate space to work safely, our crew can remove it efficiently with minimal disruption to your property. We carefully plan each removal, take the tree down in manageable sections when needed, and clean up the work area when the job is complete.\nLarge & Difficult Tree Removal|Large, mature trees can be challenging to remove safely, especially when they are close to homes, garages, fences or other trees. Our team has the equipment and experience to remove large trees efficiently while minimizing impact to your property.\nHazardous & Dead Tree Removal|Dead, dying, leaning or structurally compromised trees can become a serious safety risk. We can evaluate the tree's condition, determine the safest approach and remove it before it causes damage to your home or property.\nStorm-Damaged Tree Removal|High winds, heavy snow and severe storms can split trees, break major limbs or leave trees unstable. JCE provides storm-damage removal and cleanup to safely address fallen or hazardous trees.\nSpecialized Equipment-Assisted & Tight-Access Removal|Some trees cannot be safely removed using conventional methods. When a tree is close to a house, surrounded by landscaping or located in a tight space, our specialized equipment allows us to lift large sections of the tree out in a controlled manner. This can make difficult removals safer, faster and less disruptive to your property.\nDiseased or Infested Tree Removal|Emerald ash borer, oak wilt and Dutch elm disease can cause serious damage, but the right course of action depends on the tree, the disease and how far it has progressed. JCE has many years of experience managing these diseases. We can identify what's happening and help you understand your options, from treatment and ongoing protection to removal when a tree can no longer be safely saved.",

				// No approved copy for these three, so they are switched off rather
				// than left to fall back to the theme's example text.
				'_jce_service_signs'         => '-',
				'_jce_service_included'      => '-',
				'_jce_service_pricing'       => '-',
				'_jce_service_faq'           => '-',
			),
		),
		array(
			'slug'    => 'tree-pruning',
			'title'   => 'Tree Pruning',
			'order'   => 2,
			'excerpt' => "Pruning isn't just cutting branches off. Done wrong, it stresses a tree, invites disease, and can ruin its shape for years. Our ISA-certified arborists know how each species responds to a cut, when in the season to make it, and how much a tree can lose and still stay healthy.",
			'body'    => jce_demo_body(
				array(
					"We prune for many reasons. Shaping young trees before problems set in. Removing hazardous deadwood. Cleaning up storm damage. Managing a declining ash tree. Timing matters more than people think. Pruning an oak at the wrong time of year risks introducing oak wilt, so we plan the work around your tree's health and the calendar.",
					"Every job starts with a handwritten estimate from an arborist who walks your property and explains exactly what needs to be removed and why. We clean up every branch and twig before we leave.",
				)
			),
			'meta'    => array(
				'_jce_service_eyebrow'       => 'Tree Pruning &amp; Trimming',
				'_jce_service_headline'      => 'Tree Pruning &amp; Trimming by Local Arborists',
				// No approved copy for these, so they are switched off rather than
				// left to fall back to the theme's example text.
				'_jce_service_signs'         => '-',
				'_jce_service_included'      => '-',
				'_jce_service_pricing'       => '-',
				'_jce_service_faq'           => '-',
			),
		),

		// APPROVED COPY — everything from here down is client-signed-off prose.
		// The four standard sections are switched off on each of them: none has
		// approved copy for signs / inclusions / price factors / FAQ, and the
		// fallbacks would publish invented text under the client's name.
		// Process steps are left blank deliberately, so they inherit the
		// creative brief's approved three-step Personal Estimate.
		array(
			'slug'    => 'emergency-tree-service',
			'title'   => 'Emergency Tree Service',
			'order'   => 3,
			'excerpt' => "Tree on your house? Limb blocking your driveway? Tree down after a storm? Call us now: (715) 426-0179.",
			'body'    => jce_demo_body(
				array(
					// Safety instruction, so it gets the amber callout treatment
					// rather than sitting as the second paragraph of body prose.
					'<div class="callout callout--warn"><p>If there\'s any risk to a person or downed power lines are involved, call 911 first. Otherwise, stay clear of the tree and give us a call.</p></div>',
					"During and after a storm, we're on call and working around the clock, so you'll likely reach someone directly. On a quiet night without storm activity, a call might go to voicemail, but we check it often and call back fast.",
					"We own our crane and grapple saw outright, along with the rest of our equipment fleet, so we can handle large and hazardous jobs and we're not waiting on a subcontractor to show up before we can start working on your property.",
					"Once we're on your property, we assess the situation and make it safe right away. Sometimes that means a full removal on the spot. Other times it means stabilizing the immediate danger and finishing the job once conditions allow. Either way, your yard will look better when we leave than it did when the storm hit. We document the damage and the work as we go and can help you put together what you need for your insurance claim once the job is done.",
				)
			),
			'meta'    => array(
				'_jce_service_eyebrow'       => 'Emergency Tree Service Near Me',
				'_jce_service_headline'      => 'Emergency Tree Removal Services by Local Tree Experts in the St. Croix River Valley',
				// No approved copy for these, so they are switched off rather than
				// left to fall back to the theme's example text.
				'_jce_service_signs'         => '-',
				'_jce_service_included'      => '-',
				'_jce_service_pricing'       => '-',
				'_jce_service_faq'           => '-',
			),
		),
		array(
			'slug'    => 'plant-health-care',
			'title'   => 'Plant Health Care',
			'order'   => 4,
			'excerpt' => "Most tree problems are easier to fix, and cheaper, if you catch them early. Our four licensed pesticide applicators and certified arborists diagnose what's going on with a struggling tree and recommend a plan based on that diagnosis.",
			'body'    => jce_demo_body(
				array(
					"Getting the diagnosis right matters more than people realize. Most tree diseases can be controlled if you catch them in time, but a few can't, and treating a tree for the wrong problem wastes time it may not have. Our arborists are trained to identify what's affecting your tree before recommending anything.",
					"Treatment depends on what we're dealing with. Fungicides can be sprayed on, injected into the trunk, or applied to the soil around the roots, depending on the disease. For emerald ash borer and several other insects, we use insecticide treatment. Sometimes the better fix isn't a chemical at all, in fact, pruning, fertilization, or a change in watering habits can reduce disease pressure on a tree that's just stressed. We'll walk you through the option that fits your specific tree and situation.",
					"Emerald ash borer, oak wilt, and Dutch elm disease are all active threats in the St. Croix River Valley right now. Emerald ash borer spreads mainly through moved firewood, over long distances. From late May to September adult female borers fly from tree to tree laying eggs. Oak wilt spreads through root grafts and fresh wounds during warmer months, which is part of why pruning timing matters so much, and Dutch elm disease moves between neighboring elms through root grafts as well as bark beetles. All three are manageable if you catch them early and treat them on the right timeline.",
					"Treatment plans are written out and walked through with you, and we follow up on treated trees so you know whether it worked.",
				)
			),
			'meta'    => array(
				'_jce_service_eyebrow'       => 'Tree &amp; Plant Health Care',
				'_jce_service_headline'      => 'Tree Health Care by Certified Arborists and Licensed Pesticide Applicators',
				// No approved copy for these, so they are switched off rather than
				// left to fall back to the theme's example text.
				'_jce_service_signs'         => '-',
				'_jce_service_included'      => '-',
				'_jce_service_pricing'       => '-',
				'_jce_service_faq'           => '-',
			),
		),
		array(
			'slug'    => 'tree-inspection',
			'title'   => 'Tree Inspection',
			'order'   => 5,
			'excerpt' => "Not sure if a tree is a real risk or just looks rough? A certified arborist inspection gives you a straight answer, in writing, before you decide what to do next. Most inspections take 15 to 30 minutes and include written recommendations for any follow-up work.",
			'body'    => jce_demo_body(
				array(
					"We examine the whole tree, roots to leaves, along with what's around it. Wind, lightning, and heavy rain are the conditions most tree failures happen in or right after, so we look at exposure to those along with soil conditions, slope, nearby construction, and trenching, since all of them affect how likely a tree is to fail. Every tree carries some risk, and that risk generally grows as a tree gets larger and more mature. Telling a minor flaw apart from a real hazard takes a working knowledge of tree structure and physiology, which is what our certified arborists are trained in.",
					"People call us before buying or selling a property with mature trees, when a tree looks like it's leaning more than it used to, when a neighbor's tree overhangs their yard, or to get a second opinion on a removal quote from someone else.",
					"We walk the property and give you a clear recommendation on the spot as to whether to save it, monitor it, treat it, or remove it. Written documentation is available for insurance, real estate, or municipal needs.",
				)
			),
			'meta'    => array(
				'_jce_service_eyebrow'       => 'Tree Inspections Near Me',
				'_jce_service_headline'      => 'Tree Inspections by ISA-Certified Arborists',
				// No approved copy for these, so they are switched off rather than
				// left to fall back to the theme's example text.
				'_jce_service_signs'         => '-',
				'_jce_service_included'      => '-',
				'_jce_service_pricing'       => '-',
				'_jce_service_faq'           => '-',
			),
		),
		array(
			'slug'    => 'lot-land-clearing',
			'title'   => 'Lot &amp; Land Clearing',
			'order'   => 6,
			'excerpt' => "Whether you're clearing a building site, opening up a pasture, or reclaiming an overgrown property line, land clearing takes the right equipment and a plan.",
			'body'    => jce_demo_body(
				array(
					"We walk the property first to understand what's coming out, what's staying, and what the land will be used for next. From a single overgrown lot to several acres, we bring equipment sized to the job. If frozen ground would mean less damage during a winter clearing, we'll tell you that too.",
					"Debris can be hauled off, chipped, or left as usable firewood, whatever works best for you.",
				)
			),
			'meta'    => array(
				'_jce_service_eyebrow'       => 'Land &amp; Lot Clearing',
				'_jce_service_headline'      => 'Lot &amp; Land Clearing in the St. Croix River Valley',
				// No approved copy for these, so they are switched off rather than
				// left to fall back to the theme's example text.
				'_jce_service_signs'         => '-',
				'_jce_service_included'      => '-',
				'_jce_service_pricing'       => '-',
				'_jce_service_faq'           => '-',
			),
		),
		array(
			// Was "Brush Clean Up & Mowing" — the approved copy splits mowing out
			// into its own service below, and the two cross-reference each other.
			'slug'    => 'brush-clean-up',
			'title'   => 'Brush Clean Up',
			'order'   => 7,
			'excerpt' => "Storm debris, overgrown brush, a pile of branches that's been sitting since last fall. We'll clear it out and haul it away so your property looks the way you want it.",
			'body'    => jce_demo_body(
				array(
					"We assess the scope, give you a straightforward estimate, and remove the brush completely. Brush clean-up often pairs well with a removal, pruning, or land clearing job, so ask if bundling makes sense for your project.",
				)
			),
			'meta'    => array(
				'_jce_service_eyebrow'       => 'Brush Clean Up',
				'_jce_service_headline'      => 'Brush Clean Up in the St. Croix River Valley',
				// No approved copy for these, so they are switched off rather than
				// left to fall back to the theme's example text.
				'_jce_service_signs'         => '-',
				'_jce_service_included'      => '-',
				'_jce_service_pricing'       => '-',
				'_jce_service_faq'           => '-',
			),
		),
		array(
			// New service, split out of the old "Brush Clean Up & Mowing".
			// No bundled photo yet — see inc/media.php.
			'slug'    => 'brush-mowing',
			'title'   => 'Brush Mowing',
			'order'   => 8,
			'excerpt' => "For larger overgrown areas like a back pasture, a fence line that's grown in, or land that hasn't been maintained in years brush mowing clears it fast!",
			'body'    => jce_demo_body(
				array(
					"We mow down small trees, underbrush, and deadfall to manageable ground cover. Many customers reclaim space taken over by invasive species like buckthorn and cedar. Others want to open up walking trails or clear lanes for deer hunting. Whatever the goal, we'll walk your woods with you and discuss what makes sense for the land, both for your intended use and for the long-term health of the forest. If you're dealing with established trees rather than brush and saplings, see our <a href=\"/services/lot-land-clearing/\">Land &amp; Lot Clearing</a> page instead.",
				)
			),
			'meta'    => array(
				'_jce_service_eyebrow'       => 'Brush Mowing',
				'_jce_service_headline'      => 'Brush Mowing for Overgrown Land in the St. Croix River Valley',
				// No approved copy for these, so they are switched off rather than
				// left to fall back to the theme's example text.
				'_jce_service_signs'         => '-',
				'_jce_service_included'      => '-',
				'_jce_service_pricing'       => '-',
				'_jce_service_faq'           => '-',
			),
		),
		array(
			'slug'    => 'stump-grinding',
			'title'   => 'Stump Grinding',
			'order'   => 9,
			'excerpt' => "A leftover stump can be a tripping hazard, a mower obstacle, or it can simply be in the way of whatever you want to do with that spot next. We grind it down below grade so you can plant, seed, or landscape right over it.",
			'body'    => jce_demo_body(
				array(
					"Stump grinding is priced separately from removal, so just ask us to include it in your estimate. We grind the visible stump and root flare, and we can haul away the resulting wood chips or leave them on-site for you to use.",
				)
			),
			'meta'    => array(
				'_jce_service_eyebrow'       => 'Stump Grinding',
				'_jce_service_headline'      => 'Stump Grinding in the St. Croix River Valley',
				// No approved copy for these, so they are switched off rather than
				// left to fall back to the theme's example text.
				'_jce_service_signs'         => '-',
				'_jce_service_included'      => '-',
				'_jce_service_pricing'       => '-',
				'_jce_service_faq'           => '-',
			),
		),
	);
}

/* ---------------------------------------------------------------
 * Locations
 *
 * Deliberately just the town names, priority, and ordering. The creative
 * brief's approved Service Area copy is one set of paragraphs with the town
 * name swapped in, and single-location.php renders it directly — so there is
 * nothing per-town left to import, and the invented body prose, neighborhood
 * lists, and local FAQs that used to live here were unapproved text
 * publishing under the client's name.
 *
 * Leaving body and excerpt empty is what makes the template's approved copy
 * show: a Location with editor content overrides the approved intro with it.
 * ------------------------------------------------------------- */
function jce_demo_locations() {
	return array(
		array(
			'slug'     => 'river-falls',
			'title'    => 'River Falls, WI',
			'order'    => 1,
			'priority' => 'primary',
			'excerpt'  => '',
			'body'     => '',
		),
		array(
			'slug'     => 'hudson',
			'title'    => 'Hudson, WI',
			'order'    => 2,
			'priority' => 'primary',
			'excerpt'  => '',
			'body'     => '',
		),
		array(
			'slug'     => 'prescott',
			'title'    => 'Prescott, WI',
			'order'    => 3,
			'priority' => 'primary',
			'excerpt'  => '',
			'body'     => '',
		),
		array(
			'slug'     => 'ellsworth',
			'title'    => 'Ellsworth, WI',
			'order'    => 10,
			'priority' => 'secondary',
			'excerpt'  => '',
			'body'     => '',
		),
		array(
			'slug'     => 'new-richmond',
			'title'    => 'New Richmond, WI',
			'order'    => 11,
			'priority' => 'secondary',
			'excerpt'  => '',
			'body'     => '',
		),
		array(
			'slug'     => 'hastings',
			'title'    => 'Hastings, MN',
			'order'    => 12,
			'priority' => 'secondary',
			'excerpt'  => '',
			'body'     => '',
		),
		array(
			'slug'     => 'roberts',
			'title'    => 'Roberts, WI',
			'order'    => 13,
			'priority' => 'secondary',
			'excerpt'  => '',
			'body'     => '',
		),
		array(
			'slug'     => 'hammond',
			'title'    => 'Hammond, WI',
			'order'    => 14,
			'priority' => 'secondary',
			'excerpt'  => '',
			'body'     => '',
		),
		array(
			'slug'     => 'baldwin',
			'title'    => 'Baldwin, WI',
			'order'    => 15,
			'priority' => 'secondary',
			'excerpt'  => '',
			'body'     => '',
		),
		array(
			'slug'     => 'beldenville',
			'title'    => 'Beldenville, WI',
			'order'    => 16,
			'priority' => 'secondary',
			'excerpt'  => '',
			'body'     => '',
		),
		array(
			'slug'     => 'houlton',
			'title'    => 'Houlton, WI',
			'order'    => 17,
			'priority' => 'secondary',
			'excerpt'  => '',
			'body'     => '',
		),
	);
}

/* ---------------------------------------------------------------
 * Testimonials
 * ------------------------------------------------------------- */
function jce_demo_testimonials() {
	return array(
		array(
			'title' => 'Brian Gresback',
			'body'  => 'The JCE Tree Service Team did a great job removing two very large poplars and trimming two others. They have the right equipment to take down big trees in a small area with virtually no property disturbance.',
			'meta'  => array(
				'_jce_rating' => 5,
			),
		),
		array(
			'title' => 'Ed',
			'body'  => 'Very friendly, competent, and careful. No lawn damage, and great clean-up afterwards.',
			'meta'  => array(
				'_jce_job_type' => 'Dead oak removal',
				'_jce_rating'   => 5,
			),
		),
	);
}

/* ---------------------------------------------------------------
 * Pages
 * ------------------------------------------------------------- */
function jce_demo_pages() {
	return array(
		// APPROVED COPY — signed off by the client. Do not rewrite it. There is
		// no approved timeline or FAQ for this page, so both are switched off
		// with a dash rather than left to fall back to the theme's example
		// text. Every other named block in the brief — Our Story, Why We
		// Still Do It the Same Way, The Crew Behind the Work, We Treat Your
		// Yard Like It's Ours, and We're Proud to Be Located in River Falls —
		// gets its own section on the page (see page-templates/template-about.php)
		// rather than being flattened into one long editor-content block.
		array(
			'slug'     => 'about',
			'title'    => 'About Us',
			'template' => 'page-templates/template-about.php',
			'excerpt'  => 'Locally-owned. Arborist-led. The highest standard of tree care. No exceptions.',
			// "Our Story" — the split section next to the crew photo.
			'body'     => jce_demo_body(
				array(
					"JCE Tree Service started in River Falls in 2001. Twenty-five years later, we're still here, still local, and still running on the same high quality standard we started with.",
					"Today JCE is a crew of 10-12, led by Joe Cardin and Ross Zimmermann, right here in River Falls. Along the way we've added ISA-certified arborists, forestry degrees, licensed pesticide applicators, and a lot more equipment all so we can treat your trees and your property with the same care whether it's a big job or a small one.",
				)
			),
			'meta'     => array(
				'_jce_page_headline'   => '25 Years of Doing Right by People and Trees in our Community.',
				'_jce_page_subheading' => 'Locally-owned. Arborist-led. The highest standard of tree care. No exceptions.',
				// "The Crew Behind the Work" — the highlight cards.
				'_jce_page_highlights' => "Four ISA-Certified Arborists|Which means the person diagnosing your tree's health has the training to be right about it, not just confident about it.\nTwo Team Members with Forestry Degrees|Which means we understand how trees behave in this climate, this soil, and these species — not tree care in general.\nFour Licensed Pesticide Applicators|Which means treatment for disease or pests comes from people licensed to do the work.\nAn Owner Who's Spent Decades in These Woods|Which means the estimate you get reflects 25 years of judgment calls on trees just like yours, in neighborhoods just like yours.\nA Crew That Sticks Around|Many of our team members have been with JCE for years, and every one of them trains on the same quality standard, so the crew that shows up is never a variable.",
				// "Why We Still Do It the Same Way".
				'_jce_page_standard'    => "We built JCE around one rule: the standard doesn't change, job to job, customer to customer. Same crew training. Same equipment. Same guy — usually the owner, Joe — walking your property, writing your estimate by hand, and explaining to you what your trees need. We offer the highest standard of tree care in the area. No exceptions.\nThat's the whole business model. It's also why more than 8 out of 10 JCE customers call us again.",
				// "We Treat Your Yard Like It's Ours".
				'_jce_page_yard'        => 'Property damage is the fear nobody tells you they have until it happens to them — the driveway that gets rutted, the flower bed that doesn\'t survive the truck, the "quick job" that leaves ruts in the lawn for a season. We\'ve spent 25 years buying equipment specifically chosen to avoid that, not just to get a tree down fast. And we clean up like we\'re the ones who have to look at your yard tomorrow (because in this community, we probably will)!',
				// "We're Proud to Be Located in River Falls".
				'_jce_page_local'       => "We're not a franchise, and we're not a crew that drives in from out of the area to work a job and leave. Joe and Ross live here. So does most of the crew. When we talk about the ash borer problem hitting River Falls and the surrounding area, it's because we're dealing with it in our neighborhoods too.\nWe're proud to support our local community where we can. We enjoy being part of the River Falls Days and the Holidazzle parade, and we support local youth sports and local fundraisers throughout the year. We don't spend a lot of money on advertising, but when we do, we try to support local businesses like WEVR and the Falls Movie Theater. We live here, work here, and we're glad to show up for the community the same way we show up for our customers.",
				'_jce_page_milestones'  => '-',
				'_jce_page_faq'         => '-',
			),
		),
		array(
			'slug'     => 'service-area',
			'title'    => 'Service Area',
			'template' => 'page-templates/template-service-area.php',
			'excerpt'  => 'River Falls, Hudson, Prescott, and the towns between them in the St. Croix River Valley.',
			// No approved intro paragraph yet for the body below the trust band —
			// the previous "We work where we live." copy here was never signed
			// off, so it stays empty rather than publishing invented text under
			// the client's name. See page-templates/template-service-area.php,
			// which already skips this section entirely when there is no content.
			'body'     => '',
			'meta'     => array(
				'_jce_page_subheading' => 'River Falls, Hudson, Prescott, and the towns between them in the St. Croix River Valley.',
				'_jce_page_highlights' => "The same crew, whichever town|We do not sub out work to whoever is closest. The truck that pulls up in Prescott is the same one that pulls up in River Falls, with the same arborist on it.\nA real estimate, not a phone number|Someone drives out and walks the property, wherever it is. We have never quoted a tree we have not stood under, and we are not going to start.\nStorm response across the whole area|When a line of weather comes through, we triage by what the tree is touching, not by how far away you are. A limb through a roof in Ellsworth outranks a routine removal next door.\nWe know the local tree problems|Emerald ash borer, oak wilt, and the storm corridor along the river behave differently in each of these towns. Twenty-five years here is why we can tell you which one you have.",
				'_jce_page_faq'        => "Do you charge more for towns further out?|No travel surcharge inside the area shown above. Beyond it, we will tell you honestly on the phone whether the drive makes us the wrong company for the job.\nMy town is not on the list. Will you still come?|Often yes, especially for larger jobs where the drive is a small share of the day. Call and describe the property and we will give you a straight answer rather than a maybe.\nHow fast can you get here after a storm?|Trees on structures and blocked driveways get triaged first, usually the same day across the whole area. Everything else is scheduled behind those, and we will tell you where in the line you are.\nDo you work on the Minnesota side?|Yes — Hastings, Afton, Lakeland, and the Lake St. Croix Beach area are all regular stops for us.",
			),
		),
		// The real /services/ page — see page-templates/template-services.php.
		// The Service post type has has_archive => false so this Page owns the
		// URL directly, the same way the "service-area" Page below owns
		// /service-area/. The Title stays short (browser tab, search results,
		// menus); the approved H1 lives in the Page Headline field instead, the
		// same framing as the Tree Removal service since removal is the primary
		// draw. There is no separate approved intro paragraph yet, so the body
		// stays empty rather than inventing one.
		array(
			'slug'     => 'services',
			'title'    => 'Services',
			'template' => 'page-templates/template-services.php',
			'excerpt'  => "A dead or hazardous tree isn't something to gamble on. Our arborists don't just take trees down, they know when a tree can be saved and when it can't, and they've got 25 years of judgment behind that call.",
			'body'     => '',
			'meta'     => array(
				'_jce_page_headline'   => 'Tree Removal by Local Tree Experts in the St. Croix River Valley',
				'_jce_page_subheading' => "A dead or hazardous tree isn't something to gamble on. Our arborists don't just take trees down, they know when a tree can be saved and when it can't, and they've got 25 years of judgment behind that call.",
			),
		),
		array(
			'slug'     => 'estimate',
			'title'    => 'Contact &amp; Free Estimate',
			'template' => 'page-templates/template-contact.php',
			'excerpt'  => 'An arborist comes out, walks the property, and hand-writes the estimate. No cost, no pressure.',
			'body'     => '',
		),
		array(
			// Must stay in sync with the jce_emergency_url Customizer default —
			// this is what the header's Storm Emergency button and the sticky
			// mobile call bar link to. Pages and Services are separate slug
			// namespaces and the Service sits under /services/, so the
			// same-named Service post is not a conflict.
			'slug'     => 'emergency-tree-service',
			'title'    => 'Emergency Tree Service',
			'template' => 'page-templates/template-emergency.php',
			'excerpt'  => 'Storm damage, a tree on a structure, or a hazardous leaner — call, do not use the form.',
			'body'     => '',
		),
	);
}

/* ---------------------------------------------------------------
 * Import
 * ------------------------------------------------------------- */

/**
 * Create a post, or update it when the caller asked to replace existing copy.
 *
 * Two modes, because both are needed at different points in a build:
 *  - Default: anything whose slug already exists is left alone, so a re-run
 *    after adding one new service cannot touch the other eight.
 *  - Replace: existing posts are rewritten from the copy in this file. This is
 *    how approved copy lands on top of the placeholder text an earlier import
 *    created. It overwrites edits made in WordPress, so it is off by default
 *    and the admin screen states plainly what it does.
 *
 * @return string 'created', 'updated' or 'skipped'.
 */
function jce_demo_insert( $post_type, $item, &$log, $replace = false ) {
	$existing = get_page_by_path( $item['slug'], OBJECT, $post_type );

	// A protected item is never overwritten, whatever the checkbox says. These
	// are posts whose approved copy lives in WordPress rather than in this
	// file, so a Replace run would destroy the only copy of it.
	if ( $existing && ! empty( $item['protect'] ) ) {
		$log[] = sprintf(
			/* translators: 1: post type, 2: post title */
			__( 'Protected %1$s "%2$s" — left untouched; its copy lives in WordPress, not in the importer.', 'jce' ),
			$post_type,
			$item['title']
		);
		return 'skipped';
	}

	if ( $existing && ! $replace ) {
		$log[] = sprintf(
			/* translators: 1: post type, 2: post title */
			__( 'Skipped %1$s "%2$s" — already exists.', 'jce' ),
			$post_type,
			$item['title']
		);
		return 'skipped';
	}

	$fields = array(
		'post_type'    => $post_type,
		'post_title'   => wp_specialchars_decode( $item['title'] ),
		'post_name'    => $item['slug'],
		'post_content' => isset( $item['body'] ) ? $item['body'] : '',
		'post_excerpt' => isset( $item['excerpt'] ) ? $item['excerpt'] : '',
		'post_status'  => isset( $item['status'] ) ? $item['status'] : 'publish',
		'menu_order'   => isset( $item['order'] ) ? $item['order'] : 0,
	);

	$was_update = false;
	if ( $existing ) {
		$fields['ID'] = $existing->ID;
		$was_update   = true;
		// Keep the published slug exactly as it is. Rewriting post_name on an
		// indexed URL is the one thing here that would cost real traffic.
		unset( $fields['post_name'] );
	}

	$post_id = wp_insert_post( $fields, true );

	if ( is_wp_error( $post_id ) ) {
		$log[] = sprintf(
			/* translators: 1: post title, 2: error message */
			__( 'Failed to save "%1$s": %2$s', 'jce' ),
			$item['title'],
			$post_id->get_error_message()
		);
		return 'skipped';
	}

	if ( ! empty( $item['meta'] ) ) {
		foreach ( $item['meta'] as $key => $value ) {
			update_post_meta( $post_id, $key, $value );
		}
	}

	if ( ! empty( $item['priority'] ) ) {
		update_post_meta( $post_id, '_jce_location_priority', $item['priority'] );
	}

	if ( ! empty( $item['template'] ) ) {
		update_post_meta( $post_id, '_wp_page_template', $item['template'] );
	}

	// WordPress silently appends a suffix when a slug is already taken. Several
	// of these slugs are linked to by Customizer defaults (/estimate/,
	// /emergency-tree-service/, /service-area/), so a drifted slug is a broken
	// nav button rather than a cosmetic difference — say so rather than
	// reporting a clean success.
	if ( $was_update ) {
		$log[] = sprintf(
			/* translators: 1: post type, 2: post title */
			__( 'Updated %1$s "%2$s" from the approved copy.', 'jce' ),
			$post_type,
			$item['title']
		);
		return 'updated';
	}

	$actual = get_post_field( 'post_name', $post_id );
	if ( $actual !== $item['slug'] ) {
		$log[] = sprintf(
			/* translators: 1: post title, 2: requested slug, 3: slug actually assigned */
			__( 'Created "%1$s", but WordPress assigned the slug "%3$s" instead of "%2$s" — something already uses that URL. Check any link pointing at it.', 'jce' ),
			$item['title'],
			$item['slug'],
			$actual
		);
		return 'created';
	}

	$log[] = sprintf(
		/* translators: 1: post type, 2: post title */
		__( 'Created %1$s "%2$s".', 'jce' ),
		$post_type,
		$item['title']
	);

	return 'created';
}

/**
 * Post types the importer knows about, and the checkbox label/description
 * shown for each one's "replace" toggle on the admin screen.
 */
function jce_demo_post_types() {
	return array(
		'service'     => __( 'Services', 'jce' ),
		'location'    => __( 'Locations', 'jce' ),
		'page'        => __( 'Pages', 'jce' ),
		'testimonial' => __( 'Testimonials', 'jce' ),
	);
}

/**
 * Run the whole import.
 *
 * @param array<string,bool> $replace Which post types to overwrite, keyed by
 *                                    the keys from jce_demo_post_types(). Any
 *                                    type left out (or false) is left alone —
 *                                    existing posts of that type are only
 *                                    ever skipped, never rewritten. This is
 *                                    what lets "replace the Pages" leave
 *                                    hand-edited Services untouched.
 * @return array{created:int,skipped:int,log:string[]}
 */
function jce_run_demo_import( $replace = array() ) {
	$log     = array();
	$created = 0;
	$updated = 0;
	$skipped = 0;

	$sets = array(
		'service'     => jce_demo_services(),
		'location'    => jce_demo_locations(),
		'page'        => jce_demo_pages(),
		'testimonial' => array(),
	);

	// Testimonials have no meaningful slug of their own, so they get one
	// derived from the reviewer name to keep the import idempotent.
	foreach ( jce_demo_testimonials() as $i => $review ) {
		$sets['testimonial'][] = array_merge(
			$review,
			array(
				'slug'  => 'review-' . ( $i + 1 ) . '-' . sanitize_title( $review['title'] ),
				'body'  => $review['body'],
				'order' => $i + 1,
			)
		);
	}

	foreach ( $sets as $post_type => $items ) {
		$replace_type = ! empty( $replace[ $post_type ] );
		foreach ( $items as $item ) {
			$result = jce_demo_insert( $post_type, $item, $log, $replace_type );
			if ( 'created' === $result ) {
				$created++;
			} elseif ( 'updated' === $result ) {
				$updated++;
			} else {
				$skipped++;
			}
		}
	}

	// Permalinks for the new CPT posts won't resolve until rewrite rules are
	// rebuilt, which is the classic "imported content 404s" trap.
	flush_rewrite_rules();

	return array(
		'created' => $created,
		'updated' => $updated,
		'skipped' => $skipped,
		'log'     => $log,
	);
}

/* ---------------------------------------------------------------
 * Admin screen
 * ------------------------------------------------------------- */
function jce_register_demo_page() {
	add_management_page(
		__( 'JCE Example Content', 'jce' ),
		__( 'JCE Example Content', 'jce' ),
		'manage_options',
		'jce-demo-content',
		'jce_render_demo_page'
	);
}
add_action( 'admin_menu', 'jce_register_demo_page' );

function jce_render_demo_page() {
	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}

	$post_types = jce_demo_post_types();

	$result = null;
	if (
		isset( $_POST['jce_demo_nonce'] )
		&& wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['jce_demo_nonce'] ) ), 'jce_import_demo' )
	) {
		$replace = array();
		foreach ( array_keys( $post_types ) as $post_type ) {
			$replace[ $post_type ] = ! empty( $_POST[ 'jce_demo_replace_' . $post_type ] );
		}
		$result = jce_run_demo_import( $replace );
	}

	$counts = array(
		__( 'Services', 'jce' )     => count( jce_demo_services() ),
		__( 'Locations', 'jce' )    => count( jce_demo_locations() ),
		__( 'Testimonials', 'jce' ) => count( jce_demo_testimonials() ),
		__( 'Pages', 'jce' )        => count( jce_demo_pages() ),
	);
	?>
	<div class="wrap">
		<h1><?php esc_html_e( 'JCE Example Content', 'jce' ); ?></h1>

		<?php if ( $result ) : ?>
			<div class="notice notice-success">
				<p>
					<strong><?php
						printf(
							/* translators: 1: created, 2: updated, 3: skipped */
							esc_html__( 'Done — %1$d created, %2$d updated, %3$d skipped.', 'jce' ),
							(int) $result['created'],
							(int) $result['updated'],
							(int) $result['skipped']
						);
					?></strong>
				</p>
			</div>
			<details style="margin-bottom:1.5em;">
				<summary style="cursor:pointer;"><?php esc_html_e( 'Show details', 'jce' ); ?></summary>
				<ul style="margin-top:.75em;">
					<?php foreach ( $result['log'] as $line ) : ?>
						<li><?php echo esc_html( $line ); ?></li>
					<?php endforeach; ?>
				</ul>
			</details>
		<?php endif; ?>

		<p style="max-width:42em;">
			<?php esc_html_e( 'This creates the Services, Locations, Testimonials, and Pages the theme is built around, each one filled with realistic example copy so you can see the layouts working before the final text is written.', 'jce' ); ?>
		</p>
		<p style="max-width:42em;">
			<strong><?php esc_html_e( 'Nothing is overwritten.', 'jce' ); ?></strong>
			<?php esc_html_e( 'Anything whose slug already exists is skipped, so it is safe to run again after adding a new service or town. Edit everything afterwards in the normal WordPress screens — the example copy is ordinary post content and custom fields, not template code.', 'jce' ); ?>
		</p>

		<table class="widefat striped" style="max-width:32em;margin-bottom:1.5em;">
			<tbody>
				<?php foreach ( $counts as $label => $count ) : ?>
					<tr>
						<td><strong><?php echo esc_html( $label ); ?></strong></td>
						<td><?php echo esc_html( $count ); ?></td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>

		<form method="post">
			<?php wp_nonce_field( 'jce_import_demo', 'jce_demo_nonce' ); ?>

			<div style="max-width:42em;padding:.9em 1.1em;background:#fcf9e8;border-left:4px solid #dba617;">
				<p style="margin-top:0;">
					<strong><?php esc_html_e( 'Replace existing content — pick which post types, if any.', 'jce' ); ?></strong><br>
					<span class="description">
						<?php esc_html_e( 'Checking a box below rewrites every post of that type whose slug already exists, using the copy in this file — discarding any edits made in WordPress since, for that type only. Types left unchecked are never touched: existing posts of that type are only ever skipped, so hand-edited work is safe as long as its type stays unchecked. Published URLs are never changed.', 'jce' ); ?>
					</span>
				</p>
				<?php foreach ( $post_types as $post_type => $label ) : ?>
					<label style="display:block;margin:.5em 0;">
						<input type="checkbox" name="jce_demo_replace_<?php echo esc_attr( $post_type ); ?>" value="1">
						<?php
						printf(
							/* translators: %s: post type label, e.g. "Pages" */
							esc_html__( 'Replace %s', 'jce' ),
							esc_html( $label )
						);
						?>
					</label>
				<?php endforeach; ?>
			</div>

			<p>
				<button type="submit" class="button button-primary button-hero">
					<?php esc_html_e( 'Run Import', 'jce' ); ?>
				</button>
			</p>
		</form>

		<h2><?php esc_html_e( 'After importing', 'jce' ); ?></h2>
		<ol style="max-width:42em;">
			<li><?php esc_html_e( 'Settings > Reading — set the static front page to "Home" and the posts page to "Blog".', 'jce' ); ?></li>
			<li><?php esc_html_e( 'Appearance > Customize > Business Info — replace the placeholder phone number and fill in the address and hours.', 'jce' ); ?></li>
			<li><?php esc_html_e( 'Appearance > Menus — build the Primary menu from the imported pages.', 'jce' ); ?></li>
			<li><?php esc_html_e( 'Settings > Permalinks — click Save once, so the new Service and Location URLs resolve.', 'jce' ); ?></li>
		</ol>
	</div>
	<?php
}
