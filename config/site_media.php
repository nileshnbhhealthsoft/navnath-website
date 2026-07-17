<?php

return [
    'groups' => [
        'Brand' => [
            ['field' => 'brand_logo', 'path' => 'media.brand_logo', 'label' => 'Header Logo', 'help' => 'Transparent PNG/SVG recommended.'],
            ['field' => 'brand_mark', 'path' => 'media.brand_mark', 'label' => 'Brand Mark', 'help' => 'Square logo mark for decorative use.'],
            ['field' => 'footer_logo', 'path' => 'media.footer_logo', 'label' => 'Footer Logo', 'help' => 'Transparent PNG/SVG recommended.'],
            ['field' => 'favicon', 'path' => 'media.favicon', 'label' => 'Favicon', 'help' => 'Square PNG, ICO, or SVG.'],
        ],
        'Hero & About' => [
            ['field' => 'hero_image', 'path' => 'media.hero_image', 'label' => 'Hero Image', 'help' => 'Optional. Recommended 1200 × 1200 px.'],
            ['field' => 'about_image', 'path' => 'media.about_image', 'label' => 'About Image', 'help' => 'Optional. Recommended 1000 × 1200 px.'],
        ],
        'Service Images' => [
            ['field' => 'service_image_1', 'path' => 'media.service_images.0', 'label' => 'Digital Strategy Image'],
            ['field' => 'service_image_2', 'path' => 'media.service_images.1', 'label' => 'Product Engineering Image'],
            ['field' => 'service_image_3', 'path' => 'media.service_images.2', 'label' => 'Data & BI Image'],
            ['field' => 'service_image_4', 'path' => 'media.service_images.3', 'label' => 'Process Transformation Image'],
            ['field' => 'service_image_5', 'path' => 'media.service_images.4', 'label' => 'Cloud & Integration Image'],
            ['field' => 'service_image_6', 'path' => 'media.service_images.5', 'label' => 'Change & Support Image'],
        ],
        'Industry Images' => [
            ['field' => 'industry_image_1', 'path' => 'media.industry_images.0', 'label' => 'Government Image'],
            ['field' => 'industry_image_2', 'path' => 'media.industry_images.1', 'label' => 'Healthcare Image'],
            ['field' => 'industry_image_3', 'path' => 'media.industry_images.2', 'label' => 'Education Image'],
            ['field' => 'industry_image_4', 'path' => 'media.industry_images.3', 'label' => 'Financial Services Image'],
            ['field' => 'industry_image_5', 'path' => 'media.industry_images.4', 'label' => 'Retail Image'],
            ['field' => 'industry_image_6', 'path' => 'media.industry_images.5', 'label' => 'Infrastructure Image'],
        ],
        'Case Studies' => [
            ['field' => 'work_image_1', 'path' => 'media.work_images.0', 'label' => 'Case Study 1 Image', 'help' => 'Recommended 1200 × 850 px.'],
            ['field' => 'work_image_2', 'path' => 'media.work_images.1', 'label' => 'Case Study 2 Image', 'help' => 'Recommended 1200 × 850 px.'],
            ['field' => 'work_image_3', 'path' => 'media.work_images.2', 'label' => 'Case Study 3 Image', 'help' => 'Recommended 1200 × 850 px.'],
        ],
        'Testimonials & Contact' => [
            ['field' => 'testimonial_avatar_1', 'path' => 'media.testimonial_avatars.0', 'label' => 'Testimonial 1 Avatar', 'help' => 'Optional square portrait.'],
            ['field' => 'testimonial_avatar_2', 'path' => 'media.testimonial_avatars.1', 'label' => 'Testimonial 2 Avatar', 'help' => 'Optional square portrait.'],
            ['field' => 'contact_image', 'path' => 'media.contact_image', 'label' => 'Contact Section Image', 'help' => 'Optional. Recommended 1000 × 1200 px.'],
        ],
    ],
];
