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
		array(
			'slug'    => 'tree-removal',
			'title'   => 'Tree Removal',
			'order'   => 1,
			'excerpt' => 'Large and complex removals handled safely, from a dying ash to an oak leaning over the roofline.',
			'body'    => jce_demo_body(
				array(
					'Removal is about two-thirds of what we do, and it is the reason the equipment in our yard looks the way it does. Most of the trees we take down are not stumps in an open field — they are sixty feet of dead ash twelve feet from a bedroom window, or a silver maple that has been dropping limbs on a garage roof for two summers.',
					'That kind of tree does not get felled. It gets dismantled: a climber or a lift puts a person in the canopy, and the tree comes out in pieces small enough to control, each one rigged down rather than dropped. It is slower than cutting at the base, and it is the entire difference between a removal and a repair bill.',
					'Before any of that happens, an ISA-certified arborist walks the property and tells you whether the tree actually needs to come down. Sometimes it does not, and we will say so. A dead limb is not a dead tree, and a tree that can be pruned back into safety is a smaller invoice than one that comes out — we would rather write that estimate and keep your phone number.',
				)
			),
			'meta'    => array(
				'_jce_service_signs'    => "Dead branches you can see from the ground|Bare limbs still bare in July are not late to leaf out. That wood is gone, and it will come down on its own schedule if it does not come down on ours.\nA lean that is new|Most leaning trees are fine and always have been. A lean that changed after a storm, with soil heaving on the opposite side, is a root-plate failure in progress.\nMushrooms or brackets at the base|Fungal growth on the trunk or root flare usually means decay is already well established in the part of the tree holding it up.\nA split fork or a crack in the trunk|Two trunks growing tight together with bark trapped in the join is the single most common failure we get called out to after a storm.\nIt is over something that matters|The same tree is a low priority in the back forty and urgent twelve feet from a bedroom. What is underneath it counts as much as its condition.",
				'_jce_service_included' => "On-site assessment by an ISA-certified arborist before any number is written\nComplete removal of the tree, rigged down in sections where the drop zone is not clear\nAll equipment, rigging, and traffic control the job requires\nBrush chipped and hauled out the same day\nWood cut to length and stacked where you want it, if you are keeping it\nThe lawn raked and blown clean before we leave\nProof of liability and workers compensation insurance, handed over before we start",
				'_jce_service_pricing'  => "Size and species|A sixty-foot silver maple and a sixty-foot oak are not the same job. Wood density changes the rigging, the cuts, and the hours.\nWhat is underneath it|Open lawn is the inexpensive version. Over a roof, a fence, a pool, or a power line, the tree comes out in small controlled pieces, and that is where the time goes.\nAccess|If the crane or the chipper can get within reach, the job is faster. A backyard behind a narrow gate is carried out by hand, log by log.\nCondition|A dead or decayed tree cannot be climbed safely, so it needs equipment a healthy tree would not.\nWhat you want left behind|Standard cleanup is included. Keeping the wood, grinding the stump, or hauling the chips off instead of leaving them all move the number.",
				'_jce_service_faq'      => "How long does a removal take?|Most residential removals are a single day, and a straightforward one is often a morning. Anything involving a crane over a structure runs longer, because the rigging is the slow part. We will tell you which one yours is when we quote it.\nWill your equipment wreck my lawn?|This is the question we get most, and it is why our equipment looks the way it does. Tracked machines spread weight instead of concentrating it, and we mat the ground when conditions call for it. Frozen or dry ground is ideal — if waiting two weeks would save your turf, we will say so.\nIs the stump included?|Not by default, because plenty of people leave it. Stump grinding is quoted as its own line item so you can decide, and it is cheaper done at the same visit than as a separate trip.\nDo I need a permit?|For a tree on private property, generally not. Boulevard and right-of-way trees belong to the municipality — we will tell you which side of that line yours is on and handle the permitting if it is needed.\nWhat happens to the wood?|It leaves with us unless you want it. Plenty of customers keep the rounds for firewood and we will stack them wherever you like at no extra charge.",
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
		array(
			'slug'    => 'emergency-tree-service',
			'title'   => 'Emergency Tree Service',
			'order'   => 3,
			'excerpt' => 'Storm damage, a tree on a structure, or a hazardous leaner. Call and we will tell you straight what happens next.',
			'body'    => jce_demo_body(
				array(
					'When a tree comes down on a house at eleven at night, what you need is not marketing. It is someone who picks up, asks the right three questions, and tells you honestly whether this is a tonight problem or a tomorrow problem.',
					'Most storm calls are not emergencies in the strict sense. A tree across the lawn can wait for daylight and a proper crew. A limb resting on a roof usually can too, as long as nobody is under it. What genuinely cannot wait is a tree in contact with a power line, a trunk holding tension against a structure that is still moving, or anything blocking the only way out of a property. We triage on that basis, not on who called first.',
					'Storm work is rigging work. A tree that has already failed is loaded in ways an intact tree is not — bent, compressed, and storing energy in places that are not obvious. Taking weight off a structure in controlled pieces with a crane and proper rigging is a completely different job from cutting a standing tree, and it is the reason this is not work for whoever knocks on your door the morning after.',
				)
			),
			'meta'    => array(
				'_jce_service_signs'    => "A tree or limb on the house|Move people and pets out of the rooms underneath it and call. Do not go up to look at it.\nAnything touching a power line|Assume every wire in contact with a tree is live. Call your utility first, then us. We do not touch energised lines and neither should you.\nA trunk that is still moving|A tree resting against a structure is holding tension and can shift without warning. Stay well clear and let us take the load off it.\nBlocked access|A tree across the only driveway is an emergency even when nothing is damaged, because it is between you and everything else.\nA leaner that was not leaning yesterday|New lean plus heaved soil means the root plate has failed. That tree is coming down; the only question is whether it happens on our terms.",
				'_jce_service_included' => "Phone triage by someone who can actually assess it, not a call service\nSame-day response for trees on structures, lines, or access routes\nControlled dismantling with crane and rigging rather than dropping the tree\nWeight taken off the structure before anything else happens\nPhotographs and a written damage description in the format insurers accept\nFull debris removal and site cleanup once the hazard is gone\nA clear answer about what happens next, given to you on the phone",
				'_jce_service_pricing'  => "Urgency|Same-day and after-hours response costs more than scheduled work, because it means pulling a crew off another job.\nWhat the tree is resting on|A tree on the lawn is a normal removal. A tree on a roof is rigging work, and the hours go into taking the load off safely.\nEquipment required|Most storm work over a structure needs the crane. That is the difference between a straightforward job and a complex one.\nExtent of the debris|A whole canopy across a yard is a lot more material to process than a single failed limb.\nInsurance documentation|Included at no extra charge — we would rather you get the claim paid.",
				'_jce_service_faq'      => "Do you answer the phone at night?|Yes, for storm calls. Call rather than using the contact form — a form sits in an inbox and a tree on your roof does not wait for business hours.\nHow fast can you get here?|Trees on structures, on lines, or blocking access are triaged first, usually same-day across our whole service area. Everything else goes on the schedule behind those, and we will tell you honestly where in the line you are.\nWill insurance cover this?|Usually, when a tree has damaged a structure. You get photographs and a written description of the damage and the work in the format adjusters actually accept. We cannot file the claim for you, but we can make it straightforward.\nWhat should I do before you arrive?|Stay away from downed lines and from the tree itself. Move people and pets out of any room under the damage. Take photos from a safe distance, and have your address and cross street ready when you call.",
			),
		),
		array(
			'slug'    => 'plant-health-care',
			'title'   => 'Plant Health Care',
			'order'   => 4,
			'excerpt' => 'Four licensed pesticide applicators treating the diseases and pests actually showing up in our area.',
			'body'    => jce_demo_body(
				array(
					'Most tree companies remove trees. Fewer are set up to keep one alive, which is why so much of what gets diagnosed around here as "the tree is dying" is actually something treatable that nobody looked at closely enough.',
					'We have four licensed pesticide applicators on staff and two forestry degrees behind the diagnosis. That combination matters because the treatable problems in western Wisconsin are specific and time-sensitive: emerald ash borer, oak wilt, apple scab, spider mites in a dry August, and the slow decline that comes from a tree planted too deep twenty years ago and strangling on its own roots.',
					'Timing is most of the battle. Ash treated before the canopy starts thinning usually holds; ash treated after it is half gone usually does not. Oak wilt spreads through root grafts between neighbouring trees, so the response is about the trees around the sick one as much as the sick one itself. What we sell here is the assessment first — including, often, the news that the tree does not need treating at all.',
				)
			),
			'meta'    => array(
				'_jce_service_signs'    => "Thinning canopy at the top of an ash|Ash decline starts high and works down. By the time you notice it from the driveway, treatment is a much harder call.\nAn oak dropping leaves in midsummer|Oak wilt moves fast and spreads to neighbouring oaks underground. This one is worth a same-week look.\nD-shaped exit holes or splitting bark|Classic emerald ash borer. Woodpecker activity stripping bark off an ash means the same thing.\nLeaves spotting, curling, or dropping early|Usually fungal, usually treatable, and usually a bigger deal on young trees than mature ones.\nA trunk that goes straight into the ground|No visible root flare means the tree is planted too deep or girdled by its own roots — slow decline with a mechanical cause, not a pest.",
				'_jce_service_included' => "Diagnosis by an ISA-certified arborist before anything is applied\nTreatment by licensed pesticide applicators, correctly timed to the pest or disease\nEmerald ash borer trunk injection on the schedule the product actually requires\nOak wilt management, including the neighbouring trees sharing root grafts\nSoil and planting-depth assessment where decline has a mechanical cause\nA written plan covering what happens this year and what happens next\nAn honest answer when a tree is too far gone to be worth treating",
				'_jce_service_pricing'  => "Trunk diameter|Injection products are dosed by trunk size, so a large ash costs more to treat than a small one.\nHow many trees|Treating several on one visit is substantially cheaper per tree than separate trips.\nThe treatment interval|Ash injections generally hold for two seasons. That is the honest comparison against removal cost — per two years, not per year.\nWhether neighbours are involved|Oak wilt work sometimes means severing root grafts between properties, which is more involved than treating a single tree.\nDiagnosis alone|If you only want an assessment and a plan, that is what we quote.",
				'_jce_service_faq'      => "Is it worth treating my ash tree?|It depends on the tree and how far along it is. A healthy ash with a full canopy in a spot where you would miss it is usually worth treating — the cost over two years is well under what removal and replanting runs. An ash already thinning at the top usually is not, and we will tell you that rather than take the money.\nHow often does ash treatment need repeating?|Generally every two years with the products we use. It is an ongoing commitment for as long as you want the tree, which is exactly the conversation to have before starting rather than after.\nCan you save a tree with oak wilt?|Sometimes, if it is caught very early. More often the work is about protecting the healthy oaks around it, because the fungus moves through connected root systems. Speed matters more here than with almost anything else we treat.\nAre the treatments safe around pets and children?|The trunk injections we use for ash go into the tree, not onto the ground or into the air, and there is no re-entry period. For anything applied differently we will tell you what to expect before we do it.",
			),
		),
		array(
			'slug'    => 'tree-inspection',
			'title'   => 'Tree Inspection',
			'order'   => 5,
			'excerpt' => 'An arborist assessment that tells you when a tree needs to come down, and when it can be saved.',
			'body'    => jce_demo_body(
				array(
					'Sometimes the question is not what to do about the tree. It is whether there is anything to do at all — and the person best placed to answer that has no financial interest in the answer being yes.',
					'A tree inspection is an ISA-certified arborist walking the property and giving you a written assessment: species, condition, structural defects, what is likely to fail and roughly when, what is treatable, and what the honest priority order is if there is more than one tree in question. It is the service people call for before buying a house, after a storm has spooked them, when a neighbour is making noises about a shared tree, or when an insurer or a municipality wants something in writing.',
					'It is also the right call when another company has told you a tree has to come down and something about that did not sit right. We are not going to tell you a tree is fine to be contrary. But we do see trees condemned that had another twenty years in them, and a second opinion costs a great deal less than a removal.',
				)
			),
			'meta'    => array(
				'_jce_service_signs'    => "You are buying or selling a property|Mature trees are an asset or a liability and the difference is not visible to a home inspector. Find out before closing.\nAnother company said it has to come down|Get a second opinion from someone who is not quoting the removal. Sometimes they are right; often enough they are not.\nA neighbour dispute over a shared tree|A written assessment from a certified arborist is the document that ends these conversations.\nAfter a big storm|Trees that survived a storm can still have failed internally. What matters is what moved, not what fell.\nYour insurer or the city has asked|Both usually want a written report from a certified arborist, which is precisely what this is.",
				'_jce_service_included' => "A site visit by an ISA-certified arborist, on foot, around the whole tree\nSpecies identification and an assessment of overall condition\nStructural defects documented — cracks, cavities, included bark, root issues\nA risk assessment framed around what is underneath the tree\nA written report you can hand to an insurer, a buyer, or a municipality\nA clear recommendation: monitor, prune, treat, or remove\nA priority order when several trees are involved",
				'_jce_service_pricing'  => "Number of trees|A single tree is quick. A full property inventory on an acreage takes a morning.\nDepth of the report|A verbal recommendation on site costs less than a formal written report prepared for an insurer or a court.\nAccess and terrain|Bluff lots and heavily wooded properties simply take longer to walk properly.\nDiagnostic work needed|Most assessments are visual. Where decay needs measuring, that is additional and we will tell you before doing it.\nFollow-up|If you go ahead with work we recommend, the inspection fee comes off that estimate.",
				'_jce_service_faq'      => "Is an estimate the same as an inspection?|No, and the difference matters. An estimate is free and answers what the work would cost. An inspection is a paid professional assessment and answers whether the work is needed at all, in writing, from someone with a certification behind it.\nWill you tell me a tree is fine if it is fine?|Yes. That is the whole product. We have talked plenty of people out of removals, and it is the reason those people call us again.\nCan you tell if a tree is rotten inside?|Often, from external signs — fungal brackets, cavities, sound and response to a mallet, the pattern of deadwood. Where it genuinely matters and is not visible, we will say so rather than guess.\nHow long does the report take?|The visit is usually under an hour for one or two trees. A written report follows within a few days.",
			),
		),
		array(
			'slug'    => 'lot-land-clearing',
			'title'   => 'Lot &amp; Land Clearing',
			'order'   => 6,
			'excerpt' => 'Clearing for building sites, fence lines, and overgrown acreage on larger country properties.',
			'body'    => jce_demo_body(
				array(
					'Clearing a building site, opening a fence line, or reclaiming acreage that has gone to buckthorn and box elder is different work from residential tree care, and it needs different machines. Forestry mulchers, tracked skid steers, and grapple equipment do in a day what a crew with chainsaws does in a week.',
					'The judgement call on these jobs is what stays. A cleared lot with three good oaks left standing is worth considerably more than a cleared lot, and those oaks have to be identified before the machines start, not after. We walk the site with you first and mark what is worth keeping — which usually includes trees a bulldozer operator would not have looked at twice.',
					'The other half of the judgement is what happens to the material. Mulching in place is fastest and leaves a layer that suppresses regrowth. Hauling everything off leaves a clean site but costs more. Burning, where it is permitted, sits in between. Which one is right depends on what the ground is going to be used for, and that is a conversation before the quote rather than after.',
				)
			),
			'meta'    => array(
				'_jce_service_signs'    => "You are building|Clearing a footprint plus access and staging, with the trees worth keeping identified and protected before anything starts.\nA fence line has disappeared|Ten years of buckthorn and box elder along a property line, cut back to something you can maintain again.\nPasture or field edges creeping in|Woody encroachment takes usable acres out of production a few feet a year until someone stops it.\nInvasive species taking over|Buckthorn and honeysuckle outcompete everything and come back from cut stumps. Clearing without treating the stumps is a two-year fix.\nOvergrown acreage you cannot walk|Sometimes the goal is just to be able to use land you own again.",
				'_jce_service_included' => "A walk-through before quoting, marking what stays and what goes\nForestry mulching, tracked equipment, and grapple work as the site calls for\nSelective clearing that protects the trees worth keeping\nStump treatment on invasives so they do not simply resprout\nMaterial mulched in place or hauled off, whichever suits the end use\nErosion considerations on slopes and near water discussed up front\nA finished grade you can actually build on, fence, or mow",
				'_jce_service_pricing'  => "Acreage and density|An acre of scattered box elder and an acre of mature timber are entirely different jobs.\nStem size|Forestry mulchers handle small stuff quickly. Anything above about eight inches needs to be taken down and processed separately.\nTerrain|Flat and dry is fast. Slopes, wet ground, and rock all slow equipment down and sometimes rule it out.\nWhat happens to the material|Mulching in place is the economical option. Hauling everything off is the expensive one.\nSelectivity|Clearing everything is quicker than clearing around trees that have to survive it.",
				'_jce_service_faq'      => "How much can you clear in a day?|With a forestry mulcher on reasonable terrain and small-diameter growth, an acre or more. Heavier timber or difficult ground is a good deal slower, and we would rather give you an honest range after walking it.\nDo I need a permit?|Sometimes — shoreland zoning, wetland setbacks, and county ordinances all apply in this area and they are not intuitive. We will flag what we know of and tell you who to call, but the permit is the landowner's responsibility.\nWill the brush grow back?|Buckthorn and honeysuckle absolutely will from cut stumps, which is why stump treatment is part of the job rather than an upsell. Without it you are doing this again in two years.\nCan you leave some trees?|Yes, and you should. Tell us what matters, or let us walk it with you and point out what is worth keeping. It is the single biggest difference between a cleared lot and a good one.",
			),
		),
		array(
			'slug'    => 'brush-clean-up',
			'title'   => 'Brush Clean Up &amp; Mowing',
			'order'   => 7,
			'excerpt' => 'Overgrown brush cut back and hauled out, leaving the property usable again.',
			'body'    => jce_demo_body(
				array(
					'Not every job is a tree. A lot of what we get called for is the slow encroachment that happens at the edges of a property — the treeline pushing into the lawn, the ditch nobody has cut in three years, the pile of storm debris at the back of the lot that has become its own ecosystem.',
					'This is straightforward work and we price it that way. Brush mowing for rough ground and ditch banks, hand cutting where machines cannot reach or where there is something worth preserving, chipping on site, and hauling out whatever should not stay. It is often the job that gets a property back to a state where normal maintenance is possible again.',
					'It also pairs naturally with everything else we do. If we are already on site for a removal, adding the brush line at the back of the property costs a fraction of what a separate visit would — the expensive part of any job is getting the equipment there.',
				)
			),
			'meta'    => array(
				'_jce_service_signs'    => "The treeline is advancing on the lawn|Woody growth reclaims mowed ground a few feet a year. Cutting it back once is much cheaper than doing it after another five.\nDitches and banks nobody can mow|Too steep or too rough for a lawn mower, and exactly what brush mowing equipment is built for.\nStorm debris still sitting where it fell|Brush piles are a fire and pest issue and they only get harder to deal with as they settle.\nAn overgrown fence line|You cannot maintain a fence you cannot get to.\nA property you have just bought|Clearing the neglect is usually the first step to knowing what you actually own.",
				'_jce_service_included' => "Brush and small-diameter growth cut back to the line you want\nMowing of rough ground, ditch banks, and field edges\nHand cutting where equipment cannot reach or where plantings need protecting\nOn-site chipping of everything that can be chipped\nStorm debris and old brush piles removed\nThe finished area raked and left tidy, not just cut\nCombined pricing when it runs alongside other work on the property",
				'_jce_service_pricing'  => "Area and density|The size of the area and how thick the growth is are most of the number.\nStem size|Anything a brush mower can take is quick. Larger stems have to be cut and processed separately.\nTerrain|Slopes, wet ground, and rock all slow equipment down or force hand work.\nHaul-off|Chipping on site is included. Trucking the material away is extra.\nCombined with other work|Substantially cheaper when we are already on site for a removal or pruning job.",
				'_jce_service_faq'      => "Do you haul the brush away?|We chip what can be chipped and take the chips with us unless you want them. Larger material and anything that will not chip is hauled off for an additional charge, or stacked on site if you would rather deal with it yourself.\nCan you get into wet or steep ground?|Usually, with tracked equipment. There is a point where the honest answer is to wait for frozen ground, and we will tell you when that is the case rather than tear up your property.\nHow short do you cut it?|As close to ground level as the terrain safely allows. Where there are rocks or stumps hidden in the growth, cutting height goes up — for the equipment's sake and the operator's.\nIs this cheaper if you are already here?|Considerably. Mobilising the equipment is the expensive part, so adding brush work to a scheduled removal costs a fraction of a separate trip.",
			),
		),
		array(
			'slug'    => 'stump-grinding',
			'title'   => 'Stump Grinding',
			'order'   => 8,
			'excerpt' => 'Grinding down what is left so you can put grass, garden, or patio back where the tree stood.',
			'body'    => jce_demo_body(
				array(
					'A stump is a trip hazard, a mower killer, a termite and carpenter ant hotel, and — if it is a species that suckers — the start of a dozen new saplings across the lawn. Grinding it out is what turns a removal into a finished job.',
					'The machine takes the stump and the major surface roots down below grade, typically eight to twelve inches, which is enough for turf, a garden bed, or paving. Deeper than that if you are planting a replacement tree in the same spot, which is worth saying up front because it changes how we do it.',
					'What is left behind is a pile of grindings, and you have a choice about them. Left in place they settle over a season and make perfectly good fill once mixed with soil. Hauled off, you get a clean hole ready for topsoil right away. Neither is wrong; the second costs more. And it is always cheaper to grind at the same visit as the removal than to bring the machine back separately.',
				)
			),
			'meta'    => array(
				'_jce_service_signs'    => "You want lawn back|Grinding below grade is what lets you topsoil, seed, and mow over the spot as if nothing was there.\nSuckers coming up around it|Some species keep sending up shoots from the stump and roots for years. Grinding stops it.\nIt is a hazard|Stumps in a lawn are exactly the wrong height to see and the right height to catch a foot or a mower deck.\nInsects have moved in|Decaying stumps attract carpenter ants and termites, and they are close to the house by definition.\nYou are replanting|A new tree cannot go in where the old stump is. Grinding deeper makes the spot usable again.",
				'_jce_service_included' => "Stump ground to eight to twelve inches below grade as standard\nMajor surface roots ground out where they run through the work area\nUtility locate arranged before the machine touches the ground\nGrindings raked back into the hole and levelled, or hauled off if you prefer\nThe surrounding lawn protected and cleaned up afterward\nDeeper grinding where a replacement tree is going into the same spot\nDiscounted pricing when done at the same visit as the removal",
				'_jce_service_pricing'  => "Diameter|Stumps are priced largely by width across the cut. Measure at the widest point, including the flare.\nHow many|Several stumps on one visit cost far less each than a single stump on its own trip.\nAccess|The grinder needs to get there. A backyard behind a narrow gate means a smaller machine and more time.\nGrindings|Leaving them is included. Hauling them away and bringing in topsoil is extra.\nDepth|Standard depth suits lawn and paving. Going deeper for a replacement tree takes longer.",
				'_jce_service_faq'      => "How deep do you grind?|Eight to twelve inches below grade as standard, which is enough for turf, beds, or paving. If you are planting a new tree in the same spot, say so and we will go deeper.\nWhat happens to the grindings?|By default they go back in the hole and get levelled — they settle over a season and make fine fill mixed with soil. If you want a clean hole for topsoil, we will haul them off for an extra charge.\nCan I plant grass right away?|Once the grindings are topped with a few inches of soil, yes. Planting straight into pure grindings does not work well; they are wood, and they tie up nitrogen as they break down.\nWhat about the roots?|We grind the major surface roots running through the work area. The deeper root system stays and decays in place over several years, which is harmless.\nIs it cheaper with the removal?|Yes, noticeably. Most of the cost is getting the machine to your property, so combining the visits saves you money.",
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
		array(
			'slug'     => 'about',
			'title'    => 'About Us',
			'template' => 'page-templates/template-about.php',
			'excerpt'  => 'Family-owned in River Falls since 2001, still run by the person who writes your estimate.',
			'body'     => jce_demo_body(
				array(
					'<h2>A local crew, not a franchise passing through.</h2>',
					'Joe Cardin founded JCE Tree Service in River Falls in 2001. Twenty-five years later the company is still family-owned, still based here, and still run by someone who lives in the same community as the people he works for.',
					'That matters more than it sounds like it should. It means the person who wrote your estimate is the person you can call afterward. It means the crew knows which streets have the ash problem and which oaks should not be touched in July. And it means our reputation here is the only marketing that has ever really worked for us — most of our customers call us again, and most of the rest were sent by a neighbor.',
					'People think anyone with a chainsaw can take down a tree. Sometimes that is true. The difference shows up in what your yard looks like the next morning.',
				)
			),
			'meta'     => array(
				'_jce_page_highlights' => "We tell you when not to do it|The fastest way to lose a customer for twenty years is to take down a tree that did not need to come down. We would rather write the smaller estimate and keep the phone number.\nThe owner is still on the property|Joe walks most estimates himself. There is no sales department here, and nobody working on commission is deciding what your tree needs.\nThe yard matters as much as the tree|Every machine we own was bought with turf in mind. If the ground is too soft, we will tell you to wait rather than leave you with ruts to repair.\nThe crew stays|Most of our people have been here for years, and they train continuously. That is unusual in this trade, and it is the reason the work is consistent.",
				'_jce_page_milestones' => "2001|Joe starts JCE|One truck, one chainsaw, and a phone number handed around River Falls. The first customers are neighbors, which sets the tone for everything after.\n2008|First bucket truck|The jobs stop being ones that can be climbed. Buying lift equipment means taking on the removals other companies were turning down.\n2013|Emerald ash borer arrives|The beetle reaches western Wisconsin and changes the work permanently. We add licensed pesticide applicators so we can treat the ash worth saving instead of only removing the ones that are gone.\n2017|Crane and spider lift|Equipment that can reach over a house without touching the lawn. It is what makes the difficult backyard removals possible at all.\n2021|Four certified arborists on staff|Two forestry degrees among them. The assessments stop being one person's judgement and start being a standard.\n2026|Twenty-five years, same town|Still family-owned, still based in River Falls, still mostly working for people who found us through someone they know.",
				'_jce_page_faq'        => "Are you actually local, or a national brand with a local name?|Local. One owner, one location, in River Falls since 2001. If you call the number on this site during business hours, you are calling an office a few miles from your house.\nHow big is the crew?|Big enough to run multiple jobs at once and bring real equipment to each of them, small enough that the owner still knows every property we are working on that week.\nWho will I actually deal with?|Joe or one of our certified arborists for the estimate, and the same crew leader through the job itself. You will not be handed between a salesperson and a stranger.\nDo you do commercial and municipal work?|Yes — property managers, HOAs, and municipal contracts alongside the residential work. The standards are the same either way.",
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
 * Create a post if nothing with that slug and type exists yet.
 *
 * @return string 'created' or 'skipped'.
 */
function jce_demo_insert( $post_type, $item, &$log ) {
	$existing = get_page_by_path( $item['slug'], OBJECT, $post_type );
	if ( $existing ) {
		$log[] = sprintf(
			/* translators: 1: post type, 2: post title */
			__( 'Skipped %1$s "%2$s" — already exists.', 'jce' ),
			$post_type,
			$item['title']
		);
		return 'skipped';
	}

	$post_id = wp_insert_post(
		array(
			'post_type'    => $post_type,
			'post_title'   => wp_specialchars_decode( $item['title'] ),
			'post_name'    => $item['slug'],
			'post_content' => isset( $item['body'] ) ? $item['body'] : '',
			'post_excerpt' => isset( $item['excerpt'] ) ? $item['excerpt'] : '',
			'post_status'  => isset( $item['status'] ) ? $item['status'] : 'publish',
			'menu_order'   => isset( $item['order'] ) ? $item['order'] : 0,
		),
		true
	);

	if ( is_wp_error( $post_id ) ) {
		$log[] = sprintf(
			/* translators: 1: post title, 2: error message */
			__( 'Failed to create "%1$s": %2$s', 'jce' ),
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
function jce_run_demo_import() {
	$log     = array();
	$created = 0;
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
			if ( 'created' === jce_demo_insert( $post_type, $item, $log ) ) {
				$created++;
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
		$result = jce_run_demo_import();
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
							/* translators: 1: number created, 2: number skipped */
							esc_html__( 'Done — %1$d created, %2$d skipped.', 'jce' ),
							(int) $result['created'],
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
			<p>
				<button type="submit" class="button button-primary button-hero">
					<?php esc_html_e( 'Import Example Content', 'jce' ); ?>
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
