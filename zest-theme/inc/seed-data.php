<?php
/**
 * Seed content – verticals, services, pages and jobs.
 * Source: "Zest Holdings Profile" and "JH × ZH" decks + client's 3-vertical brief.
 * Edit anything later in wp-admin; re-running the seed never overwrites existing items.
 *
 * @package zest
 */

defined( 'ABSPATH' ) || exit;

/**
 * Verticals.
 *
 * @return array
 */
function zest_seed_verticals() {
	return array(
		'security-services'                => array(
			'name'        => 'Security Services',
			'menu_label'  => 'Security Services',
			'order'       => 1,
			'icon'        => 'guard',
			'badge'       => 'PSARA licensed',
			'tagline'     => 'Manned guarding, banking and cash services, executive protection, dog squads and electronic surveillance – delivered by trained, vetted and supervised personnel.',
			'short'       => 'Corporate and industrial guarding, banking & cash services, executive protection, dog squad, electronic surveillance and security consulting.',
			'description' => "Incorporated in 2006, Zest is one of the leading security service companies in India. With a deep understanding of the strategic and operational challenges in security, we provide personalised solutions that help clients achieve their security objectives.\n\nOur well-trained officers are deployed across states, protecting valuable human life and securing corporate and individual assets. Every officer is selected through a multi-stage process – physical strength checks, detailed background verification and experience checks – and strengthened with structured training to meet industry and region-specific requirements. We comply fully with the Private Security Agencies (Regulation) Act 2007 and all statutory obligations.",
			'highlights'  => "Rigorous selection | Physical strength checks, detailed background verification and experience checks for every officer.\nTrained before deployment | Pre-employment training at our Pusegaon (Satara) and Wangani (Thane) centres – fitness, first aid, firefighting and self-defence.\nSupervised round the clock | Area officers, supervisors and a 24×7 back office keep every site accountable.\nFully compliant | PSARA Act 2007, minimum wages, PF, ESIC, gratuity and bonus – for every employee.\nTechnology-enabled | Tab-based field reporting, electronic surveillance and smart security solutions.\nClient retention | A dedicated workforce and committed service that have earned our clients’ long-term trust.",
		),
		'housekeeping-facility-management' => array(
			'name'        => 'Housekeeping & Facility Management',
			'menu_label'  => 'Housekeeping & FM',
			'order'       => 2,
			'icon'        => 'broom',
			'badge'       => 'Integrated facility services',
			'tagline'     => 'Spotless, secure and pleasant workplaces – from daily housekeeping and deep cleaning to pest control, horticulture and M&E maintenance.',
			'short'       => 'Office, commercial, industrial and healthcare housekeeping, deep cleaning, pest control and integrated facility management.',
			'description' => "Zest Facility Services ensures your work environment is spotless, secure and pleasant. We deliver everything from housekeeping and pantry services to cleaning classrooms, staff rooms, conference rooms, play areas and swimming pools – as well as support for functions, annual meets, exhibitions and social gatherings.\n\nBeyond cleaning, our integrated facility management teams take care of mechanical, electrical and plumbing maintenance, minor civil works, warehouse operations, space and vendor management – so you can focus on your core business with a single, accountable partner.",
			'highlights'  => "Trained, groomed staff | Housekeeping teams trained in methods, chemicals, equipment and safe work practices.\nRight chemicals & equipment | Best-in-class, biodegradable and non-hazardous chemicals and modern machines.\nSupervised & audited | On-site supervisors with checklists, audits and regular client reviews.\nOne accountable partner | Housekeeping, pest control, horticulture and M&E maintenance under one contract.\nStatutory compliance | Minimum wages, PF, ESIC, gratuity and bonus for every employee.\nFlexible deployment | Day-to-day teams plus on-demand deep cleaning and event support.",
		),
		'cafeteria-food-services'          => array(
			'name'        => 'Cafeteria & Food Services',
			'menu_label'  => 'Cafeteria Services',
			'order'       => 3,
			'icon'        => 'utensils',
			'badge'       => 'Food services',
			'tagline'     => 'Wholesome, hygienic and affordable food for your people – corporate cafeterias, industrial canteens, institutional catering, pantry and vending.',
			'short'       => 'Corporate cafeteria management, industrial canteens, institutional catering, employee meal programmes, pantry and vending.',
			'description' => "Zest provides a wide selection of wholesome, nutritious and affordable food – fast food, specialty and business menus – with a balanced mix of Indian, South Indian, Asian and international cuisines to suit varied tastes.\n\nWe offer complete support for cafeteria and food-court management, including organising, operating and outsourcing partners with a single point of responsibility and accountability. Our kitchen hygiene and stewarding practices – built around the four Cs of food hygiene: cleaning, cooking, chilling and avoiding cross-contamination – keep every kitchen safe and inspection-ready.",
			'highlights'  => "Balanced menus | Rotating Indian, regional and international menus planned for nutrition, taste and budget.\nFood safety first | The four Cs of food hygiene – cleaning, cooking, chilling and avoiding cross-contamination.\nTrained kitchen teams | Cooks, service staff and kitchen stewards trained in hygiene and service standards.\nSingle point of accountability | One partner for operations, vendors, pantry and vending.\nScalable | From a single office pantry to large industrial canteens and multi-site programmes.\nCompliant workforce | Minimum wages, PF, ESIC, gratuity and bonus for every employee.",
		),
	);
}

/**
 * Services. Keys: vertical, title, excerpt, tagline, icon, content (HTML), features, industries.
 *
 * @return array slug => data
 */
function zest_seed_services() {
	return array(

		/* ------------------------------------------------------------ Security */
		'manned-guarding'                 => array(
			'vertical'   => 'security-services',
			'title'      => 'Manned Guarding',
			'icon'       => 'guard',
			'excerpt'    => 'Trained, vetted security officers for corporate offices, IT parks, residential complexes, retail and public spaces.',
			'tagline'    => 'Well-trained security officers as part of an effective security deployment strategy – protecting people, property and assets 24×7.',
			'content'    => '<p>We provide well-trained security officers as part of an effective security deployment strategy. Our officers are deployed across states, protecting valuable human life and securing corporate and individual assets.</p><p>Each officer is selected through a multi-stage process – physical strength checks, detailed background verification and experience checks – and then strengthened with up to 180 hours of training to meet industry and region-specific security requirements and regulations.</p><p>Our work covers private and public sector security, secure transit, infrastructure security, heritage sites and large public and private utilities. With a dedicated workforce and committed service, we have earned our clients’ trust and long-term relationships.</p><h2>Our manned guarding portfolio</h2><ul><li>Corporate &amp; residential security services</li><li>IT parks and commercial buildings</li><li>Fire marshals and traffic wardens</li><li>Reception, front-desk and access control</li><li>Patrolling, gate and perimeter security</li><li>Events &amp; exhibition security support</li></ul>',
			'features'   => "Multi-stage selection and background verification\nUp to 180 hours of structured training\nUniformed, groomed and supervised officers\nAccess control, visitor and material movement registers\nFire marshals and traffic wardens\nRegular patrolling with site reporting\nArea officer and supervisor visits\nPSARA-compliant deployment",
			'industries' => "Corporate offices & MNCs\nIT parks & commercial buildings\nResidential societies\nMalls & retail\nEducational institutions\nHeritage sites & public utilities",
		),
		'industrial-infrastructure-security' => array(
			'vertical'   => 'security-services',
			'title'      => 'Industrial & Infrastructure Security',
			'icon'       => 'factory',
			'excerpt'    => 'Gate, perimeter and asset security for factories, plants, warehouses, construction and infrastructure sites.',
			'tagline'    => 'Disciplined security for factories, plants, warehouses and infrastructure projects – controlling people, vehicles and materials at every gate.',
			'content'    => '<p>Industrial and infrastructure sites face a very different set of risks – large perimeters, high-value materials, heavy vehicle movement, contract labour and round-the-clock operations. Our industrial security teams are trained to manage all of these with discipline and clear processes.</p><p>We secure manufacturing plants, warehouses and distribution centres, construction and infrastructure projects, and large utilities. Deployments combine trained guards and supervisors with electronic surveillance, so every gate, vehicle and material movement is controlled and recorded.</p><h2>What we cover</h2><ul><li>Main gate, material gate and perimeter security</li><li>Inward/outward material and vehicle checks</li><li>Contract labour entry and identity control</li><li>Night patrolling and vulnerable-point checks</li><li>Fire safety support and emergency response</li><li>Integration with CCTV, access control and intrusion systems</li></ul>',
			'features'   => "Gate, perimeter and patrol security\nMaterial and vehicle movement control\nContract labour identity checks\nFire safety and emergency drills\nCCTV and access-control integration\nShift-wise supervision and reporting",
			'industries' => "Manufacturing plants\nWarehouses & logistics parks\nConstruction & infrastructure projects\nUtilities\nPorts & transit facilities",
		),
		'banking-atm-services'            => array(
			'vertical'   => 'security-services',
			'title'      => 'Banking & ATM Services',
			'icon'       => 'bank',
			'excerpt'    => 'ATM Plus caretaking, housekeeping and site upkeep for ATMs and bank branches, backed by a 24×7 back office.',
			'tagline'    => 'Comprehensive ATM management services – caretaking, housekeeping, site repair and maintenance and end-to-end site support for banks.',
			'content'    => '<p>Zest Group is a leading provider of comprehensive ATM management services. ATMs have become the most preferred source for customers’ everyday banking needs – they are the face of the bank and a brand presence in the market. The rapid increase in ATMs has made timely monitoring and site upkeep to the highest standards a real challenge.</p><h2>ATM Plus</h2><p>Most monitoring stops at online fault detection – communication problems, card jams and non-functional machines. But what about the issues customers actually experience, such as cooling, lighting and cleanliness? ATM Plus is a specialised system, built around the challenges banks face in running ATM centres, that adds value to every ATM and to the bank’s image.</p><h2>On-site services</h2><ul><li>A 24×7 facility attendant who acts as caretaker of the ATM centre and attends to entry and exit</li><li>Daily log book of site history and cheques collected by CIT agents</li><li>Regular day-and-night reporting to the control room, and immediate escalation in an emergency</li></ul><h2>Support services</h2><ul><li>Housekeeping – sweeping, mopping, garbage removal and regular cleaning of entrance, signage and blinds</li><li>Electrical – replacement of bulbs, switches, MCBs and holders; provision of generators</li><li>Civil work – restoration, plastering, painting, tiling, waterproofing, woodwork and plumbing</li><li>AC maintenance – servicing of window and split ACs, repairs and gas recharging</li><li>Fire extinguisher and first-aid box at every centre</li></ul><h2>Back office &amp; TAB technology</h2><p>ATM Plus is backed by a 24×7 back office and call centre that attends to grievances and coordinates between the client, facility attendants, support staff and area managers. Every call is uniquely tagged and closed only once it is satisfactorily addressed. Our field officers use tablets integrated with customised software to log calls, material requirements and site events – downtime and service reports are generated automatically and shared with clients.</p>',
			'features'   => "24×7 facility attendant at the ATM\nHousekeeping and air-freshening\nElectrical, civil and AC maintenance\nFire extinguisher and first-aid provision\n24×7 call centre with tagged complaints\nTab-based field reporting\nAutomated downtime and service reports\nSite repair and maintenance (SRM)",
			'industries' => "Banks\nATM networks\nFinancial institutions\nBranch networks",
		),
		'cash-in-transit-cash-management' => array(
			'vertical'   => 'security-services',
			'title'      => 'Cash-in-Transit & Cash Management',
			'icon'       => 'van',
			'excerpt'    => 'ATM replenishment, cash pick-up, cash vaults and secure logistics for currency, bullion and valuables – in protected vans with armed staff.',
			'tagline'    => 'Low-risk, high-reliability cash logistics – ATM replenishment, doorstep banking, cash pick-up, vaulting and secure transport of valuables.',
			'content'    => '<p>Zest Group provides cash replenishment and cash-in-transit (CIT) management for bank ATMs on a best-practices model. Our professional monitoring and management service promises a low-risk, high-reliability experience.</p><p>Our ATM services include replenishment, first-line maintenance delivered around the clock, and cash processing – including counterfeit note verification, cash sorting, specialised packaging, safekeeping and vaults. We replenish ATMs on weekdays and holidays, and provide basic hardware and software maintenance so users face no difficulty. Cash is carried in specially protected vans with armed security staff always on board.</p><p>Through cash-in-transit, doorstep banking, ATM services, and bullion and cash vaulting, we serve banks, financial institutions, organised retail, and jewellery processing units.</p><h2>Cash logistics services</h2><ul><li><strong>Cash pick-up</strong> – collecting cash from bank vaults, large retailers, petrol stations and other high-volume outlets, processing it and depositing it at the customer’s bank</li><li><strong>Cash vault services</strong> – currency inventory management, branch deposit processing, branch cash orders by denomination, currency chest processing and commercial deposit processing</li><li><strong>Secure logistics</strong> – tailor-made transport of currency, bullion, gems, jewellery and luxury goods using vaults, semi-armoured vans, vehicle monitoring systems and a centralised control room</li></ul><h2>Why outsource cash handling to Zest</h2><ul><li><strong>Risk management</strong> – remove excess cash from your premises and limit exposure to internal and external theft</li><li><strong>Productivity</strong> – your teams stay focused on your core business</li><li><strong>Cost savings</strong> – reduce reliance on expensive in-house risk processes and training</li><li><strong>Customer confidence</strong> – visible, professional cash handling reassures customers</li><li><strong>Peace of mind</strong> – transfer the risk and liability of cash transportation to a trusted partner</li></ul>',
			'features'   => "ATM cash replenishment, including holidays\nCash pick-up and deposit\nCurrency inventory and vault management\nCounterfeit verification and cash sorting\nSecure transport of bullion and valuables\nProtected vans with armed staff\nVehicle monitoring and central control room\nBranch deposit and cash order processing",
			'industries' => "Banks & currency chests\nFinancial institutions\nOrganised retail\nPetrol stations\nJewellery & bullion",
		),
		'electronic-surveillance'         => array(
			'vertical'   => 'security-services',
			'title'      => 'Electronic Surveillance & Command Centres',
			'icon'       => 'camera',
			'excerpt'    => 'End-to-end design, supply, installation and monitoring of CCTV, access control, intrusion and fire detection systems.',
			'tagline'    => 'One-stop electronic security – from survey and design to procurement, installation, monitoring and maintenance.',
			'content'    => '<p>We provide end-to-end electronic security services using modern technology – conducting surveys, analysing requirements, designing the solution, and implementing and installing electronic security systems. Monitoring from a central command centre lets a small team watch over many sites and respond faster.</p><p>We also offer customised security packages for warehousing, construction, retail, banking, educational institutions and hospitality.</p><h2>Our systems</h2><ul><li>CCTV surveillance and video management</li><li>Access control and entry automation</li><li>Intrusion detection systems</li><li>Scanners, explosive and metal detection</li><li>Fire detection and public address systems</li><li>Command-centre monitoring and alerts</li></ul><p>Explore our <a href="/smart-solutions/">smart security solutions</a> – visitor management, LPR parking, facial recognition, people counting and digital displays.</p>',
			'features'   => "One-stop security solutions provider\nSite survey and requirement analysis\nSolution design and implementation\nCCTV, access control and intrusion detection\nMetal, explosive and fire detection\nCentral monitoring and command centres\nAnnual maintenance and support\nCost-effective, tailor-made packages",
			'industries' => "Warehousing\nConstruction\nRetail\nBanking\nEducational institutions\nHospitality",
		),
		'executive-protection'            => array(
			'vertical'   => 'security-services',
			'title'      => 'Executive Protection & Bodyguards',
			'icon'       => 'user',
			'excerpt'    => 'Personal protection officers for executives, NRIs, public figures, celebrities and high-risk individuals.',
			'tagline'    => 'Discreet close protection that safeguards not only the person, but also their reputation, brand and image.',
			'content'    => '<p>Our executive protection services assure complete peace of mind. Our executives understand the importance of protecting not merely the principal in person, but also their reputation, brand and image.</p><p>We take a holistic approach to close protection, checking every aspect that needs to be considered from a threat perspective – including home security assessments, city, state and country risk reports, and travel advisories.</p><h2>We provide executive protection to</h2><ul><li>Corporate executives</li><li>NRIs and visiting delegations</li><li>Political officials</li><li>High-profile, security-conscious individuals</li><li>Celebrities</li><li>Sports persons</li></ul>',
			'features'   => "Trained personal protection officers\nThreat and risk assessment\nHome security assessments\nCity, state and country risk reports\nTravel advisories and route planning\nSecure transport coordination\nEvent and public-appearance cover\nDiscreet, well-groomed personnel",
			'industries' => "Corporate leadership\nMedia & entertainment\nSports\nVisiting delegations\nHigh-net-worth individuals",
		),
		'dog-squad'                       => array(
			'vertical'   => 'security-services',
			'title'      => 'Dog Squad (K9)',
			'icon'       => 'dog',
			'excerpt'    => 'Trained guard and sniffer dogs with experienced handlers for patrolling, detection and high-risk sites.',
			'tagline'    => 'Trained K9 units with experienced handlers – one of the most dependable resources in violent situations or emergencies.',
			'content'    => '<p>Our dog squad is one of the most dependable teams in violent situations or emergencies. Our dogs are bred and trained for static guarding, patrolling, sniffing, and apprehending intruders, and work with experienced, trained handlers.</p><p>Security sniffer dogs are trained to standardised levels for alert and effective detection – a strong deterrent and an extra layer of protection for high-risk premises, events and large perimeters.</p>',
			'features'   => "Trained guard and patrol dogs\nSniffer dogs for detection\nExperienced, trained handlers\nStatic guarding and perimeter patrols\nEvent and VIP area screening\nRegular training and health care",
			'industries' => "Factories & warehouses\nMalls & public venues\nEvents & exhibitions\nHotels\nHigh-risk sites",
		),
		'event-security'                  => array(
			'vertical'   => 'security-services',
			'title'      => 'Event Security Management',
			'icon'       => 'event',
			'excerpt'    => 'Planned security for product launches, corporate events, concerts, sports and exhibitions – with crowd control and emergency readiness.',
			'tagline'    => 'Specialised event security – from advance planning to crowd control and on-call fire and medical support.',
			'content'    => '<p>We provide specialised event security solutions for product launches, sports events, entertainment programmes, corporate events, concerts and many other events.</p><p>Combining current technology with careful planning and implementation, we take complete measures to protect our clients’ valuable events.</p><h2>Our planning includes</h2><ul><li>Advance planning and implementation</li><li>Media and crowd control</li><li>Coordination with government agencies and local law enforcement</li><li>Ready on-call fire and medical staff at the event</li><li>Access control, frisking and baggage screening</li><li>VIP and artist protection</li></ul>',
			'features'   => "Advance security planning\nMedia and crowd control\nLiaison with police and authorities\nOn-call fire and medical support\nAccess control and frisking\nVIP and artist protection",
			'industries' => "Corporate events\nProduct launches\nConcerts & entertainment\nSports events\nExhibitions",
		),
		'corporate-investigation'         => array(
			'vertical'   => 'security-services',
			'title'      => 'Corporate Investigation',
			'icon'       => 'search',
			'excerpt'    => 'Discreet background checks, employee and partner due diligence, theft, retail loss and forensic investigations.',
			'tagline'    => 'Discreet, ethical investigations that help you minimise risk when hiring, partnering or dealing with suspected wrongdoing.',
			'content'    => '<p>Our corporate investigation services include undercover investigations, public records research, employee theft investigation, competitive business intelligence, retail loss and theft prevention, and more. We work closely with corporate clients and their counsel to minimise risk throughout an investigation.</p><h2>Corporate investigation</h2><p>Valuable when hiring new employees, adding stakeholders or new business partners, or investigating suspicious behaviour of existing employees, partners or stakeholders.</p><h2>Forensic investigation</h2><p>We arrange bona fide DNA tests, forensic handwriting identification, and fingerprint lifting and analysis – often valuable in building a case where you need forensic tools to address your suspicions without involving the police.</p><p>As part of our strict ethics code, we do not undertake investigations for malafide intentions.</p>',
			'features'   => "Pre-employment and partner background checks\nEmployee theft investigation\nUndercover investigations\nPublic records research\nRetail loss and theft prevention\nForensic handwriting and fingerprint analysis\nIPR and brand protection support\nStrict ethics code",
			'industries' => "Corporates\nRetail\nManufacturing\nLegal firms\nFinancial services",
		),
		'security-consulting'             => array(
			'vertical'   => 'security-services',
			'title'      => 'Security Consulting, Audits & Risk Assessment',
			'icon'       => 'chart',
			'excerpt'    => 'Security audits, risk assessment, security design and staff training to build safer, more resilient organisations.',
			'tagline'    => 'Security audits, risk assessment and training that help you design a safe, secure environment for people, assets and profits.',
			'content'    => '<p>Zest is committed to providing quality, professional consulting that meets our clients’ security needs. With a committed and highly experienced team, we help clients build secure infrastructure and design environments that protect their employees, assets and profits. Our consulting projects include clients from commercial, corporate, educational, government, hospitality and sports sectors.</p><h2>Consultation &amp; training</h2><ul><li>Carrying out security audits</li><li>Understanding current and future security requirements</li><li>Developing a total security plan suited to the sensitivity of the site</li><li>Planning CCTV, smoke detectors and fire alarms</li><li>Placing armed guards at highly sensitive areas</li><li>Suggesting emergency exits and evacuation routes</li><li>Training employees in safety drills and firefighting techniques</li></ul><h2>Risk assessment</h2><p>As businesses diversify and expand, unexpected challenges can have adverse consequences. We work closely with you to understand your organisation and find solutions that build the resilience to avoid risks before they become problems.</p><ul><li>Security risk assessment and consulting</li><li>Security design assessment and consulting</li><li>Cyber security assessment and consulting</li><li>Fraud risk management</li><li>Crisis management</li><li>Travel risk management</li><li>Geo-political intelligence and analysis</li></ul>',
			'features'   => "Security audits and gap analysis\nTotal security planning\nSecurity design assessment\nFraud and crisis risk management\nTravel risk management\nFire safety and evacuation planning\nEmployee safety and firefighting training",
			'industries' => "Commercial & corporate\nEducational\nGovernment\nHospitality\nSports",
		),

		/* ---------------------------------------------- Housekeeping & FM */
		'corporate-office-housekeeping'   => array(
			'vertical'   => 'housekeeping-facility-management',
			'title'      => 'Corporate Office Housekeeping',
			'icon'       => 'building',
			'excerpt'    => 'Daily housekeeping, pantry and washroom upkeep that keeps offices spotless, hygienic and welcoming.',
			'tagline'    => 'Spotless, hygienic and welcoming offices – every workstation, meeting room, pantry and washroom, every day.',
			'content'    => '<p>Your workplace is a physical expression of your brand. Our corporate housekeeping teams keep offices spotless, secure and pleasant – from reception and workstations to conference rooms, pantries and washrooms.</p><p>Teams are trained, groomed and supervised, work to agreed checklists, and use the right chemicals and equipment for each surface.</p><h2>Routine cleaning services</h2><ul><li>High and vertical surface cleaning</li><li>Upholstery dry vacuuming</li><li>Dusting and electrical fittings/fixtures cleaning</li><li>Wall stain removal and glass cleaning</li><li>Mopping (dry and wet)</li><li>Pantry and kitchen cleaning</li><li>Washroom steam cleaning</li></ul>',
			'features'   => "Trained, groomed housekeeping staff\nWorkstation and meeting-room cleaning\nPantry and tea/coffee service\nWashroom hygiene and consumables\nGlass and upholstery cleaning\nChecklist-based supervision\nSupport for meetings and events",
			'industries' => "Corporate offices & MNCs\nBanks & financial offices\nCo-working spaces\nGovernment offices",
		),
		'commercial-buildings-it-parks'   => array(
			'vertical'   => 'housekeeping-facility-management',
			'title'      => 'Commercial Buildings & IT Parks',
			'icon'       => 'building',
			'excerpt'    => 'Common-area housekeeping, façade and glass cleaning and soft services for multi-tenant buildings and tech parks.',
			'tagline'    => 'Clean, well-run common areas that reflect the quality of your property – lobbies, lifts, parking, landscapes and washrooms.',
			'content'    => '<p>Multi-tenant buildings and IT parks need consistent standards across large common areas, high footfall and 24×7 operations. Our teams keep lobbies, lift cars, corridors, staircases, washrooms, parking and outdoor areas clean and presentable throughout the day.</p><p>Housekeeping can be combined with security, horticulture, pest control and M&amp;E maintenance for a single, accountable facility partner.</p>',
			'features'   => "Lobby, lift and corridor cleaning\nWashroom hygiene for high footfall\nGlass and high-surface cleaning\nParking and outdoor area upkeep\nHorticulture and landscaping\nWaste segregation and disposal\nIntegration with security and M&E",
			'industries' => "IT parks\nCommercial complexes\nBusiness centres\nMalls",
		),
		'industrial-housekeeping'         => array(
			'vertical'   => 'housekeeping-facility-management',
			'title'      => 'Industrial Housekeeping',
			'icon'       => 'factory',
			'excerpt'    => 'Shop-floor, warehouse and utility-area cleaning that supports safety, productivity and audit readiness.',
			'tagline'    => 'Clean, safe and audit-ready plants and warehouses – shop floors, utilities, canteens and amenity areas.',
			'content'    => '<p>Industrial sites need housekeeping that supports safety, productivity and compliance. Our teams handle shop floors, production areas, warehouses, utility areas, canteens and amenity blocks, following site safety rules and PPE requirements.</p><h2>Warehouse support</h2><p>For warehouses and distribution centres we also support day-to-day operations – receipt and unloading of goods, sorting and grading, storage, batch making, order processing, loading, inter-cellular movement, waste management and rejected-item management – keeping the distribution centre neat and clean.</p>',
			'features'   => "Shop-floor and production-area cleaning\nWarehouse and dock cleaning\nMachine-area and utility upkeep\nWaste segregation and disposal\nSafety and PPE compliance\nWarehouse operations support\nAudit-ready documentation",
			'industries' => "Manufacturing plants\nWarehouses & distribution centres\nPharma & FMCG\nLogistics parks",
		),
		'hospital-healthcare-cleaning'    => array(
			'vertical'   => 'housekeeping-facility-management',
			'title'      => 'Hospital & Healthcare Facility Cleaning',
			'icon'       => 'hospital',
			'excerpt'    => 'Disciplined cleaning and sanitisation for hospitals, clinics and diagnostic centres, with zone-wise protocols.',
			'tagline'    => 'Disciplined, zone-wise cleaning and sanitisation that supports infection control and patient comfort.',
			'content'    => '<p>Healthcare facilities demand the highest cleaning standards. Our teams follow zone-wise protocols for critical, regular and low-risk areas – OPDs, waiting areas, wards, passages, staff rooms and washrooms – with the right disinfectants and frequencies for each zone.</p><p>Housekeeping can be combined with our hospital security, people-count and indoor premises solutions to keep patients, visitors and staff safe.</p>',
			'features'   => "Zone-wise cleaning protocols\nDisinfection and sanitisation\nWard, OPD and waiting-area upkeep\nWashroom hygiene\nWaste segregation support\nTrained, supervised staff\nIntegration with hospital security",
			'industries' => "Hospitals\nClinics & nursing homes\nDiagnostic centres\nMedical colleges",
		),
		'deep-specialised-cleaning'       => array(
			'vertical'   => 'housekeeping-facility-management',
			'title'      => 'Deep & Specialised Cleaning',
			'icon'       => 'spark',
			'excerpt'    => 'Carpet and upholstery shampooing, move-in/move-out cleaning, kitchen deep cleaning and more – on demand.',
			'tagline'    => 'On-demand deep cleaning – carpets, upholstery, kitchens, move-in and move-out – with the right method for every surface.',
			'content'    => '<h2>Carpet &amp; upholstery shampooing</h2><p>We offer both dry shampoo and injection-extraction cleaning for carpets and upholstery. Our technicians carefully inspect the fabric and condition before choosing the right method – and can have your carpet dry within about two hours.</p><h2>Move-out cleaning</h2><ul><li>Thorough cleaning of bathrooms and kitchens</li><li>Washing of all floors</li><li>Wiping of cupboard exteriors; dusting of baseboards, pictures, lamp shades, window sills, furniture and light fixtures</li><li>Complete vacuuming of every room</li><li>Spot cleaning of walls, door frames and baseboards</li></ul><h2>Move-in cleaning</h2><p>A thorough clean before you move in – kitchen, fridge and stove, kitchen cabinets and counters, sinks, walls and floors.</p><h2>Kitchen hygiene &amp; stewarding</h2><p>Deep cleaning of fridges, freezers, ovens and sinks, sanitising workspaces, scrubbing floors and manual scrubbing of pots, pans and equipment.</p>',
			'features'   => "Carpet and upholstery shampooing\nInjection-extraction cleaning\nMove-in and move-out cleaning\nKitchen deep cleaning\nFloor scrubbing and polishing\nGlass and façade cleaning\nPost-event and post-renovation cleaning",
			'industries' => "Offices\nHotels & hospitality\nResidential societies\nRetail\nEducational institutions",
		),
		'pest-control-sanitisation'       => array(
			'vertical'   => 'housekeeping-facility-management',
			'title'      => 'Pest Control & Sanitisation',
			'icon'       => 'bug',
			'excerpt'    => 'Pest control management, anti-termite treatment and sanitisation for offices, homes, hospitals and institutions.',
			'tagline'    => 'Expert pest control management and anti-termite treatment – because pests can make life miserable, wherever they appear.',
			'content'    => '<p>Zest Group is an expert in pest control management and anti-termite treatment. We understand how pests can make life truly miserable – whether in a business, institution, home, hospital or any other place.</p><p>We plan scheduled treatments around your operations, use approved chemicals, and combine pest control with housekeeping and sanitisation for a cleaner, healthier site.</p>',
			'features'   => "General pest control\nAnti-termite treatment\nRodent control\nMosquito and fly control\nSanitisation and disinfection\nScheduled, documented treatments",
			'industries' => "Offices\nHospitals\nFood & hospitality\nWarehouses\nResidential societies\nEducational institutions",
		),
		'integrated-facility-management'  => array(
			'vertical'   => 'housekeeping-facility-management',
			'title'      => 'Integrated Facility Management',
			'icon'       => 'tools',
			'excerpt'    => 'MEP and plant maintenance, minor civil works, horticulture, space and vendor management – under one contract.',
			'tagline'    => 'One accountable partner for M&E maintenance, civil works, horticulture, space and vendor management.',
			'content'    => '<p>Our integrated facility management service brings together the hard and soft services that keep a building running – so you deal with one partner, one contract and one point of accountability.</p><h2>Plant maintenance</h2><ul><li>Mechanical, electrical and plumbing (MEP) services</li><li>Base-building power and air-conditioning</li><li>Operation, maintenance and repair of power and electrical services</li><li>Distribution boards and panels</li><li>Fire safety, fire alarm and suppression systems</li><li>Elevators and public address systems</li></ul><h2>Minor civil works &amp; fit-outs</h2><ul><li>Civil, carpentry, plumbing and allied works</li><li>Water management systems and pump operations</li><li>Minor repairs of sanitary fixtures; maintenance of spares</li><li>Overhead tank water levels and periodic tank cleaning</li><li>WTP / STP / ETP operation where applicable</li></ul><h2>Space &amp; vendor management</h2><p>We help you take control of your physical space inventory – occupancy, allocations and charge-backs – and reduce costs by optimising occupancy and eliminating vacancies. Vendors are selected on HSSE capability, certification, reputation, delivery and green practices, and managed through contracts with codes of conduct and SLAs.</p><h2>Also included</h2><ul><li>Horticulture and landscaping</li><li>Moves, adds and changes (MAC)</li><li>Reprographics and mailroom support</li><li>Compliance management</li></ul>',
			'features'   => "MEP and plant maintenance\nHVAC and electrical operations\nFire safety systems\nMinor civil works and fit-outs\nWater, pump and STP/ETP operations\nHorticulture and landscaping\nSpace and vendor management\nMoves, adds and changes",
			'industries' => "Corporate campuses\nIT parks\nManufacturing plants\nHospitals\nEducational institutions",
		),

		/* ------------------------------------------------------- Cafeteria */
		'corporate-cafeteria-management'  => array(
			'vertical'   => 'cafeteria-food-services',
			'title'      => 'Corporate Cafeteria Management',
			'icon'       => 'utensils',
			'excerpt'    => 'End-to-end management of employee cafeterias and food courts – menus, kitchen, service, hygiene and vendors.',
			'tagline'    => 'Great food, run professionally – complete management of your employee cafeteria or food court with one point of accountability.',
			'content'    => '<p>We provide complete support systems for cafeteria and food-court management – organising, operating and managing outsourcing partners with a single point of responsibility and accountability.</p><p>Menus offer a wholesome, nutritious and affordable selection – fast food, specialty and business menus with an appropriate mix of Indian, South Indian, Asian and international cuisines – to suit varied tastes while ensuring a balanced meal. Multi-brand food courts, with reputed food brands under one umbrella, are also available.</p>',
			'features'   => "Menu planning and rotation\nKitchen operations and staffing\nFood-court and multi-brand management\nHygiene and food safety audits\nVendor and supply management\nFeedback-driven improvement\nTransparent billing and reporting",
			'industries' => "Corporate offices & MNCs\nIT parks\nBanks & financial institutions\nBusiness centres",
		),
		'industrial-canteens'             => array(
			'vertical'   => 'cafeteria-food-services',
			'title'      => 'Industrial Canteens',
			'icon'       => 'pot',
			'excerpt'    => 'Shift-wise, nutritious and affordable meals for factory and plant workforces, run to high hygiene standards.',
			'tagline'    => 'Nutritious, affordable, on-time meals for every shift – run to strict hygiene standards.',
			'content'    => '<p>Industrial canteens need to serve large numbers, across shifts, on time and within budget – without compromising on hygiene or nutrition. We plan menus around your workforce and shift patterns and run the canteen with trained cooks, service staff and kitchen stewards.</p><p>Kitchen hygiene is built around the four Cs of food hygiene – cleaning, cooking, chilling and avoiding cross-contamination.</p>',
			'features'   => "Shift-wise meal service\nNutritious, budget-friendly menus\nHigh-volume kitchen operations\nKitchen hygiene and stewarding\nStatutory canteen compliance support\nConsumption tracking and reporting",
			'industries' => "Manufacturing plants\nWarehouses & logistics parks\nConstruction & infrastructure sites",
		),
		'institutional-catering'          => array(
			'vertical'   => 'cafeteria-food-services',
			'title'      => 'Institutional Catering',
			'icon'       => 'graduate',
			'excerpt'    => 'Hygienic, balanced meals for schools, colleges, hostels, hospitals and training institutes.',
			'tagline'    => 'Balanced, hygienic meals for students, patients, trainees and staff – planned for nutrition and served with care.',
			'content'    => '<p>Institutions have unique needs – fixed meal times, large numbers, dietary requirements and tight budgets. We plan balanced menus and run kitchens and dining halls for schools, colleges, hostels, hospitals and training institutes.</p><p>Our catering can be combined with housekeeping and security for a single, integrated campus services partner.</p>',
			'features'   => "Balanced, nutrition-focused menus\nHostel and mess management\nPatient and staff meals\nDietary and special-meal options\nKitchen hygiene and stewarding\nIntegration with campus housekeeping",
			'industries' => "Schools & colleges\nHostels\nHospitals\nTraining institutes",
		),
		'employee-meal-programmes'        => array(
			'vertical'   => 'cafeteria-food-services',
			'title'      => 'Employee Meal Programmes',
			'icon'       => 'cup',
			'excerpt'    => 'Subsidised meal programmes, packed meals and meeting/event catering designed around your people and budget.',
			'tagline'    => 'Meal programmes designed around your people and your budget – daily meals, packed meals and meeting catering.',
			'content'    => '<p>A well-run meal programme supports employee wellbeing and productivity. We design programmes around your headcount, shifts, preferences and budget – from subsidised daily meals to packed meals for field teams and catering for meetings, annual meets and events.</p>',
			'features'   => "Subsidised daily meal plans\nPacked meals for field and shift teams\nMeeting and event catering\nFestive and special menus\nHeadcount-based planning\nRegular feedback and menu reviews",
			'industries' => "Corporate offices\nFactories\nIT parks\nBanks",
		),
		'pantry-vending-management'       => array(
			'vertical'   => 'cafeteria-food-services',
			'title'      => 'Pantry & Vending Management',
			'icon'       => 'coffee',
			'excerpt'    => 'Office pantry service and vending machines stocked with fresh milk, coffee, tea and health drinks.',
			'tagline'    => 'Well-stocked pantries and vending tailored to your facility – planned around actual consumption.',
			'content'    => '<p>Our vending services are tailored to your facility’s unique requirements and preferences. Machines are planned and stocked based on consumption patterns, with the freshest products for your employees and customers.</p><p>Our offerings include fresh milk, coffee, tea and health drinks – including South Indian filter coffee and bean-to-cup freshly brewed beverages. We also manage office pantries end to end, with trained pantry staff, inventory and hygiene.</p>',
			'features'   => "Tea, coffee and beverage vending\nBean-to-cup and filter coffee\nConsumption-based stocking\nPantry staffing and service\nInventory and consumables management\nPantry hygiene and upkeep",
			'industries' => "Corporate offices\nIT parks\nBanks\nHospitals\nEducational institutions",
		),
		'central-kitchen-bulk-catering'   => array(
			'vertical'   => 'cafeteria-food-services',
			'title'      => 'Central Kitchen & Bulk Catering',
			'icon'       => 'pot',
			'excerpt'    => 'Central kitchen partnerships and bulk catering for multi-site clients, large events and institutions.',
			'tagline'    => 'Consistent quality at scale – central kitchen and bulk catering partnerships for multi-site and high-volume needs.',
			'content'    => '<p>For multi-site clients, large events and high-volume requirements, we work with central kitchen and bulk catering partners to deliver consistent quality at scale – with Zest as the single point of responsibility for menus, quality, hygiene and delivery.</p>',
			'features'   => "Central kitchen partnerships\nBulk and event catering\nMulti-site meal delivery\nStandardised recipes and quality checks\nFood-safe transport\nSingle point of accountability",
			'industries' => "Multi-site corporates\nInstitutions\nLarge events\nIndustrial clusters",
		),
	);
}

/**
 * Pages. slug => [title, content, extra meta].
 *
 * @return array
 */
function zest_seed_pages() {
	return array(
		'home'             => array( 'Home', '' ),
		'about'            => array(
			'About Us',
			'<p>Incorporated in 2006, Zest Group is one of the leading security services and facility management companies in India. With a deep understanding of the strategic and operational challenges faced in security and facility management, we focus on providing personalised solutions that help clients achieve their objectives – improving the quality and productivity of their core businesses.</p><p>Headquartered in Mumbai, our dedicated team of professionals works round the clock to ensure strict adherence to our clients’ requirements. Our ever-expanding client base – corporate offices, retail outlets, shopping malls, educational institutes, media and entertainment, real estate and infrastructure – is testimony to the quality of our services.</p><p>Owing to our commitment to our employees, our clients and society, we comply with the rules and regulations laid down by the Private Security Agencies (Regulation) Act 2007 and other statutory authorities. We use the latest technology to deliver premium services across industry verticals, and continuous training enhances the skills of our staff.</p><p>We strive to provide a personal service, staying in constant contact with our customers to ensure their complete satisfaction.</p>',
		),
		'industries'       => array( 'Industries We Serve', '' ),
		'smart-solutions'  => array( 'Smart Solutions', '' ),
		'careers'          => array( 'Careers', '' ),
		'contact'          => array( 'Contact Us', '' ),
		'request-a-quote'  => array( 'Request a Quote', '' ),
		'privacy-policy'   => array(
			'Privacy Policy',
			'<p><em>Last updated: November 2026</em></p><p>Zest Holdings Pvt. Ltd. (“Zest”, “we”, “us”) respects your privacy. This policy explains what information we collect through this website and how we use it.</p><h2>Information we collect</h2><ul><li><strong>Enquiry and quote forms</strong> – your name, phone number, email, company, location and the details of your requirement.</li><li><strong>Job applications</strong> – your name, contact details, position, experience and the CV you upload.</li><li><strong>Technical data</strong> – standard server logs and, where enabled, anonymous analytics about how the site is used.</li></ul><h2>How we use it</h2><ul><li>To respond to your enquiry, prepare proposals and provide our services.</li><li>To assess job applications and contact shortlisted candidates.</li><li>To improve our website and services.</li></ul><p>We do not sell or rent your personal information. We share it only with our staff and service providers who need it to respond to you, or where required by law.</p><h2>Retention</h2><p>Enquiries are retained for as long as needed to respond and maintain business records. CVs are retained for up to 12 months for future openings unless you ask us to delete them sooner.</p><h2>Your choices</h2><p>You may ask us to access, correct or delete your personal information at any time by emailing <a href="mailto:departmenthead@zestholdings.in">departmenthead@zestholdings.in</a>.</p><h2>Contact</h2><p>Zest Holdings Pvt. Ltd., 2nd Floor, Mahendra Chambers, 136/14 D.N. Road, near New Empire Cinema, Mumbai 400001. Phone: +91 97025 70253.</p>',
		),
	);
}

/**
 * Demo job openings (review before launch).
 *
 * @return array
 */
function zest_seed_jobs() {
	return array(
		'security-guard'        => array(
			'title'   => 'Security Guard',
			'excerpt' => 'Trained security guards for corporate, industrial and residential sites.',
			'content' => '<h2>Role</h2><p>Protect people, property and assets at client sites through access control, patrolling and incident reporting.</p><h2>Responsibilities</h2><ul><li>Access control and visitor/material registers</li><li>Regular patrolling and vulnerable-point checks</li><li>Reporting incidents to the supervisor and control room</li><li>Fire safety and emergency response support</li></ul><h2>Requirements</h2><ul><li>Minimum 10th pass; physically fit</li><li>Freshers welcome – full pre-employment training provided</li><li>Ex-servicemen preferred for select sites</li></ul><h2>Benefits</h2><ul><li>Paid training, uniform, PF, ESIC, bonus and gratuity as per law</li></ul>',
			'meta'    => array(
				'zest_location'   => 'Mumbai, Pune, Thane & other locations',
				'zest_job_type'   => 'Full-time',
				'zest_experience' => '0–5 years',
			),
		),
		'security-supervisor'   => array(
			'title'   => 'Security Supervisor',
			'excerpt' => 'Lead and supervise security teams across shifts at client sites.',
			'content' => '<h2>Role</h2><p>Supervise guards across shifts, ensure post discipline and maintain site documentation and client communication.</p><h2>Responsibilities</h2><ul><li>Shift briefings, post checks and attendance</li><li>Site registers, incident and daily reports</li><li>On-the-job training of guards</li><li>Coordination with the client and area officer</li></ul><h2>Requirements</h2><ul><li>12th pass or graduate</li><li>3+ years in security, including supervisory experience</li><li>Ex-servicemen preferred</li></ul>',
			'meta'    => array(
				'zest_location'   => 'Mumbai',
				'zest_job_type'   => 'Full-time',
				'zest_experience' => '3+ years',
			),
		),
		'housekeeping-executive' => array(
			'title'   => 'Housekeeping Staff / Supervisor',
			'excerpt' => 'Housekeeping staff and supervisors for corporate, commercial and healthcare facilities.',
			'content' => '<h2>Role</h2><p>Maintain cleaning and hygiene standards at client facilities as per agreed checklists.</p><h2>Responsibilities</h2><ul><li>Daily cleaning of work areas, pantries and washrooms</li><li>Correct use of chemicals and equipment</li><li>Supervisors: rostering, quality checks and client coordination</li></ul><h2>Requirements</h2><ul><li>Staff: freshers welcome – training provided</li><li>Supervisors: 2+ years housekeeping experience</li></ul>',
			'meta'    => array(
				'zest_location'   => 'Mumbai & Thane',
				'zest_job_type'   => 'Full-time',
				'zest_experience' => '0–3 years',
			),
		),
		'cafeteria-supervisor'  => array(
			'title'   => 'Cafeteria Supervisor',
			'excerpt' => 'Run day-to-day operations of a corporate cafeteria or industrial canteen.',
			'content' => '<h2>Role</h2><p>Manage day-to-day cafeteria operations – service, hygiene, staff and client satisfaction.</p><h2>Responsibilities</h2><ul><li>Daily service and staff rostering</li><li>Kitchen hygiene and food safety checks</li><li>Inventory, consumption tracking and reporting</li><li>Handling client and employee feedback</li></ul><h2>Requirements</h2><ul><li>Diploma/degree in hotel management preferred</li><li>2+ years in cafeteria, canteen or F&amp;B operations</li></ul>',
			'meta'    => array(
				'zest_location'   => 'Mumbai',
				'zest_job_type'   => 'Full-time',
				'zest_experience' => '2+ years',
			),
		),
	);
}
