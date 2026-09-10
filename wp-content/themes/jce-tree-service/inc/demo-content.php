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
 * so an import never overwrites edited copy.
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
			'excerpt' => 'Structural and health pruning timed to the season and the species, not just whatever week we are in the neighborhood.',
			'body'    => jce_demo_body(
				array(
					'Pruning is the work that keeps a tree off the removal list. Done right it takes weight off the limbs most likely to fail, opens the canopy so wind passes through instead of pushing against it, and clears the roof, the drive, and the power drop. Done wrong — and it is done wrong constantly — it starts decay the tree spends the next decade losing to.',
					'The difference is mostly about where the cut goes and when it happens. A cut at the branch collar seals; a flush cut or a stub does not. Oaks pruned between April and July in this part of Wisconsin invite oak wilt, which is why we schedule oak work in the dormant season and will push back if you ask for it in June. Elms have their own calendar. So does apple.',
					'What we do not do is topping. Cutting a tree back to stubs produces a flush of weak regrowth attached to nothing but decayed wood, and it is the reason so many storm failures around here are trees that were "trimmed" five years ago. If a tree is too big for its spot, that is a removal conversation, and we will have it honestly rather than sell you a service that makes the problem worse.',
				)
			),
			'meta'    => array(
				'_jce_service_signs'    => "Limbs on the roof or over the drive|Branches touching a structure abrade shingles, hold moisture against the roof, and give squirrels a bridge. Clearance pruning is the cheapest tree work there is.\nA canopy so dense the wind cannot pass|Solid crowns catch wind like a sail. Thinning reduces the load the trunk has to resist in a storm.\nCrossing or rubbing branches|Two limbs grinding on each other wear through the bark and open the tree to decay at the wound.\nA young tree growing two leaders|Fixed with one cut at five years, it becomes a removal at thirty. Structural pruning while a tree is small is the highest-value work we do.\nDeadwood scattered through the crown|Dead limbs are the ones that come down on a still day. Clearing them is a safety job before it is a cosmetic one.",
				'_jce_service_included' => "Arborist assessment of the whole tree, not just the limb you called about\nCuts made at the branch collar so the wound seals properly\nDeadwood, crossing limbs, and hazardous branches removed\nClearance pruning for roofs, drives, walkways, and utility drops\nCrown thinning to reduce wind load where the canopy warrants it\nAll brush chipped and removed, beds and lawn raked clean\nSeasonal timing advice — including telling you to wait, when waiting is right",
				'_jce_service_pricing'  => "Size of the tree|Everything above about forty feet needs a lift or a climber, and that is the main line between a quick job and a long one.\nHow much is coming out|Clearing a roofline is an hour. A full structural prune of a mature oak is most of a day.\nAccess for a lift|Where a bucket truck can reach from the drive, pruning is straightforward. Backyard trees mean climbing, which takes longer.\nSeason|Dormant-season work is faster and better for the tree. Emergency clearance in mid-summer costs more because it is scheduled around everything else.\nCleanup and haul-off|Chipping on site is included; hauling everything away versus leaving chips for your beds changes the number slightly.",
				'_jce_service_faq'      => "When is the best time to prune?|For most species, the dormant season — roughly November through March. The tree is not spending energy on leaves, the structure is visible, and disease pressure is at its lowest. Oaks especially should not be pruned April through July because of oak wilt.\nHow much can you take off at once?|As a rule, no more than about a quarter of the live canopy in a season. Beyond that the tree is stressed into producing weak regrowth. If someone offers to take half a tree off, that is a warning sign.\nWill pruning fix a leaning tree?|Sometimes. Reducing weight on the leaning side takes load off the roots and can buy years. If the lean is from root failure rather than growth habit, pruning does not address the cause and we will tell you that.\nDo you top trees?|No. Topping is the single most damaging thing done to trees in this area and we will not do it. If a tree is genuinely too large for its location, we will talk about removal instead.",
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
 * ------------------------------------------------------------- */
function jce_demo_locations() {
	return array(
		array(
			'slug'     => 'river-falls',
			'title'    => 'River Falls, WI',
			'order'    => 1,
			'priority' => 'primary',
			'excerpt'  => 'Home base since 2001. Most of our work happens within a few miles of downtown, and a good share of it comes from neighbors of people we have already worked for.',
			'body'     => jce_demo_body(
				array(
					'River Falls is where JCE started and where it still is. The shop is here, the crew lives here, and most weeks we are working within a few miles of downtown. That is not a marketing position — it is just what happens when a company stays in one place for twenty-five years.',
					'The tree stock here tells the story of when the neighborhoods went in. The blocks around the university are older and mixed, with mature oak and elm that have been through a lot and are worth taking care of. The subdivisions that went up in the seventies and eighties are heavy with ash, planted all at once because it was fast and cheap and nobody knew what was coming. A lot of what we take down now is that generation of ash, and a fair amount of what we treat is the ash worth saving.',
					'The other thing about River Falls is the ground. Between the Kinnickinnic valley and the older platted blocks, there are plenty of properties where the lot is narrow, the backyard has no vehicle access, and the tree is fifteen feet from the neighbor\'s garage. That is the job we are set up for, and it is why we own a spider lift.',
				)
			),
			'meta'     => array(
				'_jce_location_distance'      => 'Our shop is here — usually on site within the day',
				'_jce_location_zip'           => '54022',
				'_jce_location_conditions'    => "Ash from the seventies boom|Whole streets were planted with ash at the same time, and emerald ash borer has been working through them since 2013. Some can still be treated; most of what we remove now is ash.\nOak worth protecting|The older blocks near the university have mature oaks that are genuinely valuable. We prune them in the dormant season and nowhere near the oak wilt window.\nNarrow lots, no rear access|Plenty of properties here have a backyard a truck cannot reach. That is a climbing and rigging job, not a drop-it job, and it is what our lift equipment exists for.\nThe Kinni valley slopes|Properties on the valley edge have shallow rooting, more wind exposure, and access problems all at once.\nBoulevard trees the city owns|A good share of the trees people call us about between the sidewalk and the street are municipal. We will tell you before you spend anything.",
				'_jce_location_neighborhoods' => "Downtown River Falls\nUniversity neighborhood\nKinnickinnic River corridor\nSterling Ponds\nMeadowview\nWhitetail Ridge\nGlen Park area\nRural Pierce County properties",
				'_jce_location_faq'           => "Do you work in River Falls often?|We are based here. Most weeks the majority of our jobs are within a few miles of the shop, which is why our response times here are the best in our service area.\nWho owns the tree by the sidewalk?|Usually the City of River Falls, not you — which means you should not be paying to have it removed. We will tell you which side of the line your tree is on before quoting anything.\nCan you get into a backyard with no driveway access?|Usually, yes. Our smaller tracked machines fit through a standard gate, and a spider lift reaches over a house where a bucket truck cannot. Where nothing fits, we climb and rig it out by hand.\nIs my ash tree worth treating?|If the canopy is still full, often yes — treatment over two years costs well under removal and replanting. If it is already thinning at the top, usually not, and we will say so.",
			),
		),
		array(
			'slug'     => 'hudson',
			'title'    => 'Hudson, WI',
			'order'    => 2,
			'priority' => 'primary',
			'excerpt'  => 'Established neighborhoods, mature trees, and a lot of ash that needs a plan. We have been working Hudson properties for two decades.',
			'body'     => jce_demo_body(
				array(
					'Hudson has some of the best mature tree stock in the valley and some of the most expensive things to drop a tree on. The older neighborhoods off Third Street and up the hill have large oak, maple, and elm on lots that were platted long before anyone thought about getting equipment into a backyard.',
					'That combination — big trees, tight access, and houses close together — is exactly the work that separates companies. A sixty-foot maple between two homes twenty feet apart does not get felled. It gets taken apart from the top down, with a crane if we can position one on the street and by climbing if we cannot.',
					'Hudson also has a serious ash situation. The growth through the eighties and nineties put ash in as street and yard trees across whole developments, and emerald ash borer has been through. We spend as much time here treating the ash worth keeping as removing the ones that are gone — and telling people honestly which category theirs is in.',
				)
			),
			'meta'     => array(
				'_jce_location_distance'      => 'About 20 minutes from our River Falls shop',
				'_jce_location_zip'           => '54016',
				'_jce_location_conditions'    => "Large trees on close-set lots|The older neighborhoods have mature canopy over houses twenty feet apart. Everything comes down in controlled pieces here; there is nowhere to drop anything.\nAsh across whole developments|The eighties and nineties growth planted ash heavily as street and yard trees. Emerald ash borer has been through, and the decisions now are treat-or-remove on a tree-by-tree basis.\nBluff and river-facing lots|Properties toward the St. Croix have wind exposure, slope, and access constraints that all push the job toward crane work.\nStorm corridor along the river|The straight-line winds that come up the valley hit the same exposed properties repeatedly. Wind-load pruning matters more here than most places.\nMunicipal boulevard trees|A lot of Hudson's street trees belong to the city. Worth confirming before you pay anyone to touch them.",
				'_jce_location_neighborhoods' => "Downtown Hudson\nThird Street historic district\nWillow River area\nNorth Hudson\nRed Cedar Canyon\nTroy Burne\nBirkmose Park neighborhood\nRural St. Croix County properties",
				'_jce_location_faq'           => "Are you actually up here regularly, or is Hudson an outer edge?|Hudson is one of our three primary towns and has been for years. It is a twenty-minute drive and a regular part of the weekly schedule, not a stretch.\nCan you get a crane into a Hudson backyard?|Often we can position one on the street and reach over the house, which is the whole point of owning it. Where the street will not take it, a spider lift or climbing handles the job instead.\nMy whole street is ash. What should I do?|Get them assessed individually. Ash in the same block can be in very different condition, and treating the good ones while removing the failed ones is almost always cheaper than removing all of them.\nDo you do work for HOAs and property managers?|Yes, regularly — common-area tree care, storm response, and multi-property assessments across the Hudson area.",
			),
		),
		array(
			'slug'     => 'prescott',
			'title'    => 'Prescott, WI',
			'order'    => 3,
			'priority' => 'primary',
			'excerpt'  => 'Bluff properties and river lots where access and cleanup take real equipment — and knowing which trees are holding a slope together.',
			'body'     => jce_demo_body(
				array(
					'Prescott sits where the St. Croix meets the Mississippi, and the tree work here is shaped almost entirely by that topography. Bluff lots, steep driveways, properties where the back of the house is thirty feet above the front, and river frontage with mature trees doing real work holding the bank together.',
					'That last part matters more than most people expect. On a slope, a tree is not just a tree — it is root structure holding soil. Removing the wrong one on a bluff lot can start an erosion problem that costs a great deal more than the tree did. Part of what an arborist assessment gets you here is knowing which trees are structural to the site and which are not.',
					'Access is the other constant. Steep, narrow driveways rule out the largest equipment on plenty of Prescott properties, which means smaller tracked machines, more rigging, and sometimes lowering material down to the road by hand. It is slower work, and we would rather tell you that when quoting than surprise you on the day.',
				)
			),
			'meta'     => array(
				'_jce_location_distance'      => 'About 25 minutes from our River Falls shop',
				'_jce_location_zip'           => '54021',
				'_jce_location_conditions'    => "Trees holding a slope together|On bluff lots some trees are structural to the site. Taking the wrong one out starts an erosion problem worth far more than the tree. We assess for that before quoting.\nSteep and narrow access|Plenty of Prescott driveways rule out our largest equipment. Smaller tracked machines, more rigging, and sometimes hand-lowering to the road.\nWind exposure at the confluence|Properties above the river junction take wind from directions sheltered lots never see. Crown thinning is a genuine risk reduction here.\nShallow soil over rock|Bluff-top trees often root shallowly across rock rather than deep. They can look solid and fail suddenly in saturated ground.\nRiverfront cleanup constraints|Working near the water means being careful about what ends up in it. Debris handling is planned, not improvised.",
				'_jce_location_neighborhoods' => "Downtown Prescott\nBluff-top properties\nSt. Croix riverfront\nMississippi River lots\nFreedom Park area\nRural Pierce County acreages\nOak Ridge\nBig River Road corridor",
				'_jce_location_faq'           => "Can you get equipment down my driveway?|Usually — we run smaller tracked machines specifically because so many properties here cannot take a full-size truck. Where nothing fits, we climb and rig material out by hand, and we will tell you up front if that is what your site needs.\nWill removing this tree cause erosion?|On a slope it genuinely might, and it is one of the first things we assess on a bluff lot. Sometimes the right answer is to reduce the tree rather than remove it, precisely so the roots stay in the ground.\nDo you work on the riverfront?|Yes. Working near the water means planning debris handling rather than improvising it, which is part of the quote rather than an afterthought.\nHow far out is Prescott for you?|About twenty-five minutes, and it is a primary service town — there is no travel surcharge and no difference in how we schedule it.",
			),
		),
		array(
			'slug'     => 'ellsworth',
			'title'    => 'Ellsworth, WI',
			'order'    => 10,
			'priority' => 'secondary',
			'excerpt'  => 'Village lots and surrounding Pierce County farmland — removals, clearing, and storm work on the same schedule as our primary towns.',
			'body'     => jce_demo_body(
				array(
					'Ellsworth is a regular stop for us, both in the village itself and on the farms and acreages around it. The work here splits fairly evenly between residential removals on village lots and larger clearing jobs on rural property — fence lines, field edges, and windbreaks that have gone past the point of being maintainable.',
					'Rural Pierce County properties tend to have more room to work and more material to deal with. That usually means the job goes faster than the same tree in town, and the conversation is more about what happens to the wood and brush than about how to get equipment in.',
				)
			),
			'meta'     => array(
				'_jce_location_distance' => 'About 20 minutes from our River Falls shop',
				'_jce_location_zip'      => '54011',
			),
		),
		array(
			'slug'     => 'new-richmond',
			'title'    => 'New Richmond, WI',
			'order'    => 11,
			'priority' => 'secondary',
			'excerpt'  => 'Growing subdivisions with maturing tree stock, plus acreage clearing north of the river.',
			'body'     => jce_demo_body(
				array(
					'New Richmond has grown quickly, and the trees planted through that growth are now reaching the size where they need real attention rather than a homeowner with a pole saw. Structural pruning on maturing trees is some of the highest-value work we do, and this is a town with a lot of it.',
					'We also do a fair amount of lot clearing on the acreages around New Richmond — building sites, fence lines, and reclaiming ground that has gone to buckthorn and box elder.',
				)
			),
			'meta'     => array(
				'_jce_location_distance' => 'About 35 minutes from our River Falls shop',
				'_jce_location_zip'      => '54017',
			),
		),
		array(
			'slug'     => 'hastings',
			'title'    => 'Hastings, MN',
			'order'    => 12,
			'priority' => 'secondary',
			'excerpt'  => 'Across the river in Dakota County — mature neighborhood canopy and river-bluff properties.',
			'body'     => jce_demo_body(
				array(
					'Hastings is a regular stop on the Minnesota side. The older neighborhoods have excellent mature canopy on lots that were not designed with equipment access in mind, which is familiar territory for us.',
					'The bluff properties along the Mississippi bring the same slope and access considerations we deal with in Prescott, and the same caution about which trees are doing structural work holding ground in place.',
				)
			),
			'meta'     => array(
				'_jce_location_distance' => 'About 30 minutes from our River Falls shop',
				'_jce_location_zip'      => '55033',
			),
		),
		array(
			'slug'     => 'roberts',
			'title'    => 'Roberts, WI',
			'order'    => 13,
			'priority' => 'secondary',
			'excerpt'  => 'Village and rural St. Croix County work, ten minutes off the interstate from our shop.',
			'body'     => jce_demo_body(
				array(
					'Roberts and the surrounding township are close enough to our shop that scheduling is straightforward. The work is a mix of residential removals, pruning, and clearing on the rural properties around the village.',
				)
			),
			'meta'     => array(
				'_jce_location_distance' => 'About 20 minutes from our River Falls shop',
				'_jce_location_zip'      => '54023',
			),
		),
		array(
			'slug'     => 'hammond',
			'title'    => 'Hammond, WI',
			'order'    => 14,
			'priority' => 'secondary',
			'excerpt'  => 'Village lots and surrounding acreage, on the same crew schedule as the rest of St. Croix County.',
			'body'     => jce_demo_body(
				array(
					'Hammond sits in easy reach of our shop and is part of the regular St. Croix County rotation. Residential removals, pruning, and storm response all run on the same schedule and the same pricing as our primary towns.',
				)
			),
			'meta'     => array(
				'_jce_location_distance' => 'About 25 minutes from our River Falls shop',
				'_jce_location_zip'      => '54015',
			),
		),
		array(
			'slug'     => 'baldwin',
			'title'    => 'Baldwin, WI',
			'order'    => 15,
			'priority' => 'secondary',
			'excerpt'  => 'Residential tree care and rural clearing in eastern St. Croix County.',
			'body'     => jce_demo_body(
				array(
					'Baldwin is the eastern edge of our regular service area. Residential work in the village and larger clearing jobs on the farms and acreages around it make up most of what we do here.',
				)
			),
			'meta'     => array(
				'_jce_location_distance' => 'About 35 minutes from our River Falls shop',
				'_jce_location_zip'      => '54002',
			),
		),
		array(
			'slug'     => 'beldenville',
			'title'    => 'Beldenville, WI',
			'order'    => 16,
			'priority' => 'secondary',
			'excerpt'  => 'Rural Pierce County acreages, minutes from the shop.',
			'body'     => jce_demo_body(
				array(
					'Beldenville is close to home for us — mostly rural properties where the work runs to removals, windbreak maintenance, and clearing overgrown ground back to something usable.',
				)
			),
			'meta'     => array(
				'_jce_location_distance' => 'About 15 minutes from our River Falls shop',
				'_jce_location_zip'      => '54003',
			),
		),
		array(
			'slug'     => 'houlton',
			'title'    => 'Houlton, WI',
			'order'    => 17,
			'priority' => 'secondary',
			'excerpt'  => 'St. Croix riverfront and bluff properties just north of Hudson.',
			'body'     => jce_demo_body(
				array(
					'Houlton properties sit on the bluffs above the St. Croix, which brings the same access and slope-stability considerations as our Prescott work. Wind exposure on the river-facing lots makes crown thinning genuinely worthwhile here.',
				)
			),
			'meta'     => array(
				'_jce_location_distance' => 'About 25 minutes from our River Falls shop',
				'_jce_location_zip'      => '54082',
			),
		),
	);
}

/* ---------------------------------------------------------------
 * Testimonials
 * ------------------------------------------------------------- */
function jce_demo_testimonials() {
	return array(
		array(
			'title' => 'Dana R.',
			'body'  => 'We had a dead ash about fifteen feet off the back corner of the house and two other companies quoted it without getting out of the truck. Joe walked the whole yard, told us the ash had to go but that the maple we were also worried about was fine and would be for years. They took the ash down in pieces over the deck without touching a board of it. The yard was cleaner when they left than when they got here.',
			'meta'  => array(
				'_jce_reviewer_location' => 'Sterling Ponds, River Falls',
				'_jce_job_type'          => 'Large ash removal',
				'_jce_rating'            => 5,
				'_jce_review_source'     => 'Google',
				'_jce_review_service'    => 'tree-removal',
			),
		),
		array(
			'title' => 'Mark T.',
			'body'  => 'Storm took a limb through the garage roof at about nine at night. I called expecting to leave a message and someone picked up, asked exactly what it was resting on, and told me to stay out of the garage and that they would be there first thing. They were. Had the weight off the roof before the roofer even called me back, and gave me photos and a written description that my adjuster accepted without a single follow-up question.',
			'meta'  => array(
				'_jce_reviewer_location' => 'North Hudson',
				'_jce_job_type'          => 'Emergency storm removal',
				'_jce_rating'            => 5,
				'_jce_review_source'     => 'Google',
				'_jce_review_service'    => 'emergency-tree-service',
			),
		),
		array(
			'title' => 'Linda K.',
			'body'  => 'I was told by another company that my two big oaks needed to come down, which would have been about eight thousand dollars. JCE came out for a second opinion, spent forty minutes looking at them, and said both were structurally sound and just needed deadwood cleared. That was three years ago and they are still standing. I have sent them four neighbors since.',
			'meta'  => array(
				'_jce_reviewer_location' => 'University neighborhood, River Falls',
				'_jce_job_type'          => 'Tree inspection and pruning',
				'_jce_rating'            => 5,
				'_jce_review_source'     => 'Google',
				'_jce_review_service'    => 'tree-inspection',
			),
		),
		array(
			'title' => 'Steve and Pat M.',
			'body'  => 'Bluff lot, terrible driveway, and a big cottonwood that had to come out from behind the house. Every other company either would not quote it or wanted to bring in a crane we could not get up the hill. JCE brought smaller tracked equipment and lowered it out piece by piece. Two days of careful work and you cannot tell they were here except the tree is gone.',
			'meta'  => array(
				'_jce_reviewer_location' => 'Bluff-top, Prescott',
				'_jce_job_type'          => 'Difficult-access removal',
				'_jce_rating'            => 5,
				'_jce_review_source'     => 'Facebook',
				'_jce_review_service'    => 'prescott',
			),
		),
		array(
			'title' => 'Amy W.',
			'body'  => 'Had them treat four ash trees rather than remove them. What sold me was that they told me the fifth one was too far gone to be worth treating and I should take it out instead — nobody trying to sell me treatments says that. Four seasons on and all four are still full. The one they said to remove came apart in a windstorm the next spring, so they were right about that too.',
			'meta'  => array(
				'_jce_reviewer_location' => 'Red Cedar Canyon, Hudson',
				'_jce_job_type'          => 'Emerald ash borer treatment',
				'_jce_rating'            => 5,
				'_jce_review_source'     => 'Google',
				'_jce_review_service'    => 'plant-health-care',
			),
		),
		array(
			'title' => 'Greg H.',
			'body'  => 'Cleared about three acres of buckthorn and box elder that had swallowed the back of our property. They walked it with me first and flagged four oaks I would honestly have let the machine take because I did not know what I was looking at. Those four trees are now the best thing about the yard. Stump-treated everything so it has not come back.',
			'meta'  => array(
				'_jce_reviewer_location' => 'Rural Pierce County, Ellsworth',
				'_jce_job_type'          => 'Lot clearing',
				'_jce_rating'            => 5,
				'_jce_review_source'     => 'Google',
				'_jce_review_service'    => 'lot-land-clearing',
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
			'title'    => '25 Years of Doing Right by People and Trees in our Community.',
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
			'body'     => jce_demo_body(
				array(
					'<h2>We work where we live.</h2>',
					'JCE has been based in River Falls since 2001, and the shape of our service area has more to do with driving time than with drawing a circle on a map. If we can get a crew, a chipper, and a crane to your property and back in a day without the drive eating the job, you are in it.',
					'In practice that means Pierce and St. Croix counties on the Wisconsin side and the river towns just across it. We know which neighborhoods went in during the ash boom of the seventies, which bluff lots need a crane rather than a bucket, and which streets we cannot get a chip truck down. That is not local color — it is the difference between an accurate estimate and a surprise on the day.',
					'Pick your town below for what we see on trees there and the reviews from that street. Do not see it listed? Call anyway. If you are close and we can get there, we will tell you; if you are not, we will point you to someone who can.',
				)
			),
			'meta'     => array(
				'_jce_page_highlights' => "The same crew, whichever town|We do not sub out work to whoever is closest. The truck that pulls up in Prescott is the same one that pulls up in River Falls, with the same arborist on it.\nA real estimate, not a phone number|Someone drives out and walks the property, wherever it is. We have never quoted a tree we have not stood under, and we are not going to start.\nStorm response across the whole area|When a line of weather comes through, we triage by what the tree is touching, not by how far away you are. A limb through a roof in Ellsworth outranks a routine removal next door.\nWe know the local tree problems|Emerald ash borer, oak wilt, and the storm corridor along the river behave differently in each of these towns. Twenty-five years here is why we can tell you which one you have.",
				'_jce_page_faq'        => "Do you charge more for towns further out?|No travel surcharge inside the area shown above. Beyond it, we will tell you honestly on the phone whether the drive makes us the wrong company for the job.\nMy town is not on the list. Will you still come?|Often yes, especially for larger jobs where the drive is a small share of the day. Call and describe the property and we will give you a straight answer rather than a maybe.\nHow fast can you get here after a storm?|Trees on structures and blocked driveways get triaged first, usually the same day across the whole area. Everything else is scheduled behind those, and we will tell you where in the line you are.\nDo you work on the Minnesota side?|Yes — Hastings, Afton, Lakeland, and the Lake St. Croix Beach area are all regular stops for us.",
			),
		),
		array(
			'slug'     => 'services-intro',
			'title'    => 'Tree Services in River Falls, Hudson &amp; Prescott',
			'template' => '',
			'status'   => 'draft',
			'excerpt'  => 'Removal is about two-thirds of what we do. The rest is keeping the trees worth keeping healthy — and telling you honestly which is which.',
			'body'     => jce_demo_body(
				array(
					'<h2>One crew, trained for the whole list.</h2>',
					'Most homeowners find us because something needs to come down. A dead ash, a silver maple dropping limbs on the driveway, an oak that started leaning after the last storm. That is the bulk of our work and the reason the equipment in our yard looks the way it does.',
					'But an ISA-certified arborist walking your property is going to notice the rest of it too, and we would rather tell you what we see than sell you the one job you called about. Sometimes that means a tree you assumed was finished can be pruned back into shape for a fraction of a removal. Sometimes it means the tree you were not worried about is the one with a problem.',
					'Either way you get the assessment first and the number second. Below is everything we are set up to do — pick the one you came for, or call and describe what you are looking at.',
				)
			),
			'meta'     => array(
				'_jce_page_highlights' => "Save it if it can be saved|A tree with a dead limb is not a dead tree. If pruning buys you another twenty years, that is the recommendation you get, even though it is the smaller invoice.\nTake it down before it comes down|A leaning trunk over a bedroom is not a wait-and-see. We will tell you plainly when something has moved from a maintenance question to a safety one.\nTime it to the species|Oaks get pruned in the dormant season because of oak wilt. Ash gets treated before the beetle is visible, not after. The calendar is part of the recommendation.\nLeave the yard right|Every piece of equipment we own was chosen to spread weight and protect turf. Cleanup is part of the job, not a line item on top of it.",
				'_jce_page_faq'        => "Do you charge for an estimate?|No. An arborist comes out, walks the property, and hand-writes the estimate while standing there with you. There is no fee and no obligation attached to it.\nHow far ahead are you booking?|Routine removals and pruning are usually two to four weeks out, longer in the fall rush. Storm damage and anything resting on a structure jumps the queue the same day.\nAre you insured?|Fully licensed and insured for both liability and workers compensation, and we will hand you the certificate before we start. Ask every company you call for this — an uninsured crew in your tree is your liability, not theirs.\nDo you haul everything away?|Yes, unless you want the wood. Plenty of customers keep the rounds for firewood, and we will stack them wherever you want them at no extra charge. Brush and chips leave with us either way.\nWill you work with my insurance company?|On storm damage, yes. You get photographs and a written description of the damage and the work in the format adjusters actually accept.",
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
 * Run the whole import.
 *
 * @return array{created:int,skipped:int,log:string[]}
 */
function jce_run_demo_import( $replace = false ) {
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
		foreach ( $items as $item ) {
			$result = jce_demo_insert( $post_type, $item, $log, $replace );
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

	$result = null;
	if (
		isset( $_POST['jce_demo_nonce'] )
		&& wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['jce_demo_nonce'] ) ), 'jce_import_demo' )
	) {
		$result = jce_run_demo_import( ! empty( $_POST['jce_demo_replace'] ) );
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

			<p style="max-width:42em;padding:.9em 1.1em;background:#fcf9e8;border-left:4px solid #dba617;">
				<label>
					<input type="checkbox" name="jce_demo_replace" value="1">
					<strong><?php esc_html_e( 'Replace existing content', 'jce' ); ?></strong>
				</label><br>
				<span class="description">
					<?php esc_html_e( 'Rewrites Services, Locations, and Pages that already exist, using the copy above. This is how approved copy lands on top of placeholder text from an earlier import — but it also discards any edits made in WordPress since. Published URLs are never changed. Leave unchecked to add only what is missing.', 'jce' ); ?>
				</span>
			</p>

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
