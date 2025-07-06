<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home', [
        'title'   => 'Home',
        'heading' => 'Welcome to Our Learning App',
    ]);
});

Route::get('/about', function () {
    return view('about', [
        'title'   => 'About Us',
        'heading' => 'Learn More About Us',
    ]);
});

Route::get('/about-us', function () {
    return view('about-us', [
        'title'   => 'About Me',
        'heading' => 'Learn More About Me',
    ]);
});

Route::get('/contact', function () {
    return view('contact', [
        'title'   => 'Contact Us',
        'heading' => 'Get in Touch',
    ]);
});

Route::get('/projects', function () {
    $projects = [
        [
            'title'       => 'Focus – Booking Management System',
            'link'        => 'https://github.com/bushraAliArishi/graduate-project-Focus',
            'image'       => 'https://via.placeholder.com/300x200?text=Focus',
            'description' => 'A comprehensive backend system for managing booking workflows between photographers and editors, built with Java and Spring Boot.',
            'type'        => 'Backend Development',
            'tech'        => ['Java', 'Spring Boot', 'MySQL', 'Postman'],
            'highlights'  => [
                'Complete booking logic implementation',
                'Role-based access control',
                'API testing and validation',
            ],
        ],
        [
            'title'       => 'Bani – Construction Equipment Marketplace',
            'link'        => 'https://banibuilder.com/',
            'image'       => 'https://via.placeholder.com/300x200?text=Bani',
            'description' => 'A no-code marketplace platform for construction equipment rentals with advanced booking and payment systems.',
            'type'        => 'No-Code Development',
            'tech'        => ['Bubble.io', 'SEO', 'Payment Integration'],
            'highlights'  => [
                'Led a 3-member development team',
                'Custom login and financial modules',
                'Optimized for search engines',
            ],
        ],
        [
            'title'       => 'i-be X – AI Platform',
            'link'        => 'https://i-be-x.com/',
            'image'       => 'https://via.placeholder.com/300x200?text=i-be+X',
            'description' => 'Youth-centric AI platform offering smart tools, chatbots, and competitions with dynamic prompt management.',
            'type'        => 'AI Platform Development',
            'tech'        => ['Bubble.io', 'AI Integration', 'User Management'],
            'highlights'  => [
                'Integrated AI chatbots',
                'Built subscription management',
                'Developed dynamic prompt structures',
            ],
        ],
        [
            'title'       => 'i-be Hub – Internal Management System',
            'link'        => 'https://i-behub.com/',
            'image'       => 'https://via.placeholder.com/300x200?text=i-be+Hub',
            'description' => 'Centralized hub for internal task and communication management with role-based dashboards.',
            'type'        => 'Internal Systems',
            'tech'        => ['Bubble.io', 'Workflow Design', 'Documentation'],
            'highlights'  => [
                'Collected and analyzed internal requirements through regular meetings with stakeholders',
                'Designed user interfaces and backend workflows in Bubble.io',
                'Documented system requests and updates for clarity',
            ],
        ],
        [
            'title'       => 'INFNT – Project Manager',
            'link'        => 'http://infntsolutions.com',
            'image'       => 'https://via.placeholder.com/300x200?text=INFNT',
            'description' => 'A dual-purpose platform for freelancers and event planners offering listings, event creation, and integrated bookings.',
            'type'        => 'Project Management & No-Code',
            'tech'        => ['Bubble.io', 'QA Testing', 'Google Workspace Admin'],
            'highlights'  => [
                'Managed project timelines across development and operations teams',
                'Conducted feature testing and delivered UI/UX feedback',
                'Administered Google Workspace accounts and supported onboarding',
            ],
        ],
    ];

    return view('projects', [
        'title'    => 'Projects',
        'heading'  => 'My Projects',
        'projects' => $projects,
    ]);
});

Route::get('/experience', function () {
    $experiences = [
        [
            'slug'        => 'senior-technical-developer',
            'title'       => 'Senior Technical Developer',
            'company'     => 'i-be',
            'period'      => 'Jan 2024 – Present',
            'achievements'=> [
                'Managed Google Admin Console: created/deactivated 1 000+ accounts, mapped group emails, archived data.',
                'Oversaw account–device linking and workspace configurations.',
                'Published & maintained internal apps on App Store & Play Store.',
            ],
        ],
        [
            'slug'        => 'technical-specialist',
            'title'       => 'Technical Specialist',
            'company'     => 'i-be Group',
            'period'      => 'Aug 2022 – Jan 2024',
            'achievements'=> [
                'Developed backend workflows & UI in Bubble.io.',
                'Acted as interim team lead, supervised interns.',
                'Documented workflows & created usage guides in Notion.',
            ],
        ],
        [
            'slug'        => 'jiff-trainee',
            'title'       => 'No-Code Development Trainee',
            'company'     => 'JIFF Technology',
            'period'      => 'Jun 2022 – Aug 2023',
            'achievements'=> [
                'Hands-on Bubble.io app building & backend logic structuring.',
                'Practiced automations & internal tooling guided by real use-cases.',
                'Gained foundational no-code skills for production implementation.',
            ],
        ],
        [
            'slug'        => 'call-center-agent',
            'title'       => 'Call Center Agent',
            'company'     => 'Al Khuzama Trading Co.',
            'period'      => 'Jun 2021 – May 2022',
            'achievements'=> [
                'Responded to technical & service queries.',
                'Developed FAQs & troubleshooting guides for customers.',
            ],
        ],
        [
            'slug'        => 'technical-intern',
            'title'       => 'Technical Intern',
            'company'     => 'Ministry of Communications & IT',
            'period'      => 'Jan 2021 – Jun 2021',
            'achievements'=> [
                'Participated in digital transformation workshops.',
                'Documented best practices for IT operations & workflows.',
                'Built foundational knowledge in automation & cloud adoption.',
            ],
        ],
    ];

    return view('experience.index', [
        'title'       => 'Experience',
        'heading'     => 'Professional Experience',
        'experiences' => $experiences,
    ]);
});

Route::get('/experience/{slug}', function ($slug) {
    $experiences = collect([
        [
            'slug'        => 'senior-technical-developer',
            'title'       => 'Senior Technical Developer',
            'company'     => 'i-be',
            'period'      => 'Jan 2024 – Present',
            'achievements'=> [
                'Managed Google Admin Console: created/deactivated 1 000+ accounts, mapped group emails, archived data.',
                'Oversaw account–device linking and workspace configurations.',
                'Published & maintained internal apps on App Store & Play Store.',
            ],
            'details'     => 'Served as main operator of Google Admin Console for 1 000+ users—account setup, group management, archiving workflows; authored internal guides & trained staff.',
        ],
        [
            'slug'        => 'technical-specialist',
            'title'       => 'Technical Specialist',
            'company'     => 'i-be Group',
            'period'      => 'Aug 2022 – Jan 2024',
            'achievements'=> [
                'Developed backend workflows & UI in Bubble.io.',
                'Acted as interim team lead, supervised interns.',
                'Documented workflows & created usage guides in Notion.',
            ],
            'details'     => 'Oversaw platform builds in Bubble.io, customized interfaces, supervised interns, coordinated team updates and leadership communication.',
        ],
        [
            'slug'        => 'jiff-trainee',
            'title'       => 'No-Code Development Trainee',
            'company'     => 'JIFF Technology',
            'period'      => 'Jun 2022 – Aug 2023',
            'achievements'=> [
                'Hands-on Bubble.io app building & backend logic structuring.',
                'Practiced automations & internal tooling guided by real use-cases.',
                'Gained foundational no-code skills for production implementation.',
            ],
            'details'     => 'Structured training in Bubble.io—condition-based logic, responsive UI components, and automation workflows for live projects.',
        ],
        [
            'slug'        => 'call-center-agent',
            'title'       => 'Call Center Agent',
            'company'     => 'Al Khuzama Trading Co.',
            'period'      => 'Jun 2021 – May 2022',
            'achievements'=> [
                'Responded to technical & service queries.',
                'Developed FAQs & troubleshooting guides for customers.',
            ],
            'details'     => 'Managed high-volume customer interactions—resolving technical issues and creating self-help materials to boost support efficiency.',
        ],
        [
            'slug'        => 'technical-intern',
            'title'       => 'Technical Intern',
            'company'     => 'Ministry of Communications & IT',
            'period'      => 'Jan 2021 – Jun 2021',
            'achievements'=> [
                'Participated in digital transformation workshops.',
                'Documented best practices for IT operations & workflows.',
                'Built foundational knowledge in automation & cloud adoption.',
            ],
            'details'     => 'Engaged in structured training on cloud computing, automation tools, and professional digital systems; attended workshops to document and optimize IT workflows.',
        ],
    ])->keyBy('slug')->all();

    if (!isset($experiences[$slug])) {
        abort(404);
    }

    $exp = $experiences[$slug];

    return view('experience.show', [
        'title'   => $exp['title'],
        'heading' => $exp['company'] . ' • ' . $exp['period'],
        'exp'     => $exp,
    ]);
});
