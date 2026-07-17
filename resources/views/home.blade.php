@extends('layouts.app')

@section('content')
@php
    $media = static fn (string $path): ?string => filled(data_get($content, $path)) ? asset((string) data_get($content, $path)) : null;
    $phoneHref = preg_replace('/[^0-9+]/', '', (string) data_get($content, 'contact.phone'));
@endphp

<header class="site-header" id="siteHeader">
    <div class="container header-inner">
        <a class="brand" href="#home" aria-label="{{ data_get($content, 'brand.name') }} home">
            @if ($media('media.brand_mark'))
                <img class="brand-mark" src="{{ $media('media.brand_mark') }}" alt="">
            @endif
            <span class="brand-copy">
                <strong class="brand-name">{{ data_get($content, 'brand.name') }}</strong>
                <small class="brand-tagline">{{ data_get($content, 'brand.tagline') }}</small>
            </span>
        </a>

        <nav class="desktop-nav" aria-label="Primary navigation">
            <a href="#home">{{ data_get($content, 'navigation.home') }}</a>
            <a href="#about">{{ data_get($content, 'navigation.about') }}</a>
            <a href="#services">{{ data_get($content, 'navigation.services') }}</a>
            <a href="#industries">{{ data_get($content, 'navigation.industries') }}</a>
            <a href="#work">{{ data_get($content, 'navigation.work') }}</a>
            <a href="#contact">{{ data_get($content, 'navigation.contact') }}</a>
        </nav>

        <a class="button button-small header-cta" href="#contact">{{ data_get($content, 'navigation.cta') }}</a>
        <button class="menu-toggle" id="menuToggle" type="button" aria-label="Open menu" aria-expanded="false">
            <span></span><span></span>
        </button>
    </div>

    <div class="mobile-nav" id="mobileNav" aria-hidden="true">
        <div class="mobile-nav-inner">
            <a href="#home">{{ data_get($content, 'navigation.home') }}</a>
            <a href="#about">{{ data_get($content, 'navigation.about') }}</a>
            <a href="#services">{{ data_get($content, 'navigation.services') }}</a>
            <a href="#industries">{{ data_get($content, 'navigation.industries') }}</a>
            <a href="#work">{{ data_get($content, 'navigation.work') }}</a>
            <a href="#contact">{{ data_get($content, 'navigation.contact') }}</a>
        </div>
    </div>
</header>

<main>
    <section class="hero" id="home">
        <div class="hero-orb hero-orb-one"></div>
        <div class="hero-orb hero-orb-two"></div>
        <div class="container hero-grid">
            <div class="hero-copy reveal">
                <p class="eyebrow eyebrow-light"><span></span>{{ data_get($content, 'hero.eyebrow') }}</p>
                <h1>{{ data_get($content, 'hero.title_line_1') }} <strong>{{ data_get($content, 'hero.title_line_2') }}</strong></h1>
                <p class="hero-description">{{ data_get($content, 'hero.description') }}</p>
                <div class="hero-actions">
                    <a class="button button-light" href="{{ data_get($content, 'hero.primary_url') }}">
                        {{ data_get($content, 'hero.primary_button') }}
                        <span aria-hidden="true">↗</span>
                    </a>
                    <a class="text-link text-link-light" href="{{ data_get($content, 'hero.secondary_url') }}">
                        {{ data_get($content, 'hero.secondary_button') }}
                        <span aria-hidden="true">→</span>
                    </a>
                </div>
                <p class="hero-trust"><span class="trust-dot"></span>{{ data_get($content, 'hero.trust_text') }}</p>
            </div>

            <div class="hero-visual reveal reveal-delay-1">
                <div class="hero-frame">
                    @if ($media('media.hero_image'))
                        <img src="{{ $media('media.hero_image') }}" alt="" class="uploaded-fit-image">
                    @else
                        <div class="ascent-visual" aria-hidden="true">
                            <span class="visual-grid"></span>
                            <span class="visual-a visual-a-left"></span>
                            <span class="visual-a visual-a-right"></span>
                            <span class="visual-accent"></span>
                            <span class="visual-pixel p1"></span>
                            <span class="visual-pixel p2"></span>
                            <span class="visual-pixel p3"></span>
                            <span class="visual-pixel p4"></span>
                            @if ($media('media.brand_mark'))
                                <img class="visual-mark" src="{{ $media('media.brand_mark') }}" alt="">
                            @endif
                        </div>
                    @endif
                    <div class="hero-float-card">
                        <span>Integrated expertise</span>
                        <strong>Advisory × Data × Technology</strong>
                    </div>
                </div>
            </div>
        </div>

        <div class="container hero-card-row">
            @foreach (data_get($content, 'hero.cards', []) as $card)
                <article class="hero-mini-card reveal">
                    <span class="mini-number">{{ data_get($card, 'number') }}</span>
                    <div>
                        <h2>{{ data_get($card, 'title') }}</h2>
                        <p>{{ data_get($card, 'text') }}</p>
                    </div>
                </article>
            @endforeach
        </div>
    </section>

    <section class="metric-strip" aria-label="Ascent at a glance">
        <div class="container metric-grid">
            @foreach (data_get($content, 'metrics', []) as $metric)
                <div class="metric-item reveal">
                    <strong>{{ data_get($metric, 'value') }}</strong>
                    <span>{{ data_get($metric, 'label') }}</span>
                </div>
            @endforeach
        </div>
    </section>

    <section class="section section-about" id="about">
        <div class="container about-grid">
            <div class="about-visual reveal">
                <div class="about-image-wrap">
                    @if ($media('media.about_image'))
                        <img src="{{ $media('media.about_image') }}" alt="" class="uploaded-fit-image">
                    @else
                        <div class="about-art" aria-hidden="true">
                            <div class="about-art-panel panel-one"><span>01</span><strong>Think clearly</strong></div>
                            <div class="about-art-panel panel-two"><span>02</span><strong>Build deliberately</strong></div>
                            <div class="about-art-panel panel-three"><span>03</span><strong>Scale confidently</strong></div>
                            <svg viewBox="0 0 600 600" role="presentation">
                                <path d="M82 470C192 214 343 112 527 90" fill="none" stroke="currentColor" stroke-width="2" stroke-dasharray="7 10"/>
                                <circle cx="84" cy="470" r="10" fill="currentColor"/>
                                <circle cx="526" cy="90" r="10" fill="currentColor"/>
                            </svg>
                        </div>
                    @endif
                </div>
                <blockquote>{{ data_get($content, 'about.quote') }}</blockquote>
            </div>

            <div class="section-copy reveal reveal-delay-1">
                <p class="eyebrow"><span></span>{{ data_get($content, 'about.eyebrow') }}</p>
                <h2>{{ data_get($content, 'about.title') }}</h2>
                <p class="lead">{{ data_get($content, 'about.description') }}</p>
                <div class="point-list">
                    @foreach (data_get($content, 'about.points', []) as $point)
                        <div class="point-item">
                            <span class="point-icon">✓</span>
                            <div>
                                <h3>{{ data_get($point, 'title') }}</h3>
                                <p>{{ data_get($point, 'text') }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <section class="section section-services" id="services">
        <div class="container">
            <div class="section-heading split-heading reveal">
                <div>
                    <p class="eyebrow"><span></span>{{ data_get($content, 'services.eyebrow') }}</p>
                    <h2>{{ data_get($content, 'services.title') }}</h2>
                </div>
                <p>{{ data_get($content, 'services.description') }}</p>
            </div>

            <div class="service-grid">
                @foreach (data_get($content, 'services.items', []) as $index => $service)
                    <article class="service-card reveal" style="--delay: {{ ($index % 3) * 90 }}ms">
                        <div class="service-media">
                            @if ($media('media.service_images.'.$index))
                                <img src="{{ $media('media.service_images.'.$index) }}" alt="" class="uploaded-fit-image">
                            @else
                                <div class="service-pattern pattern-{{ ($index % 3) + 1 }}" aria-hidden="true">
                                    <span></span><span></span><span></span>
                                </div>
                            @endif
                            <span class="service-number">{{ data_get($service, 'number') }}</span>
                        </div>
                        <div class="service-body">
                            <h3>{{ data_get($service, 'title') }}</h3>
                            <p>{{ data_get($service, 'text') }}</p>
                            <a href="{{ data_get($service, 'link_url') }}">{{ data_get($service, 'link_text') }} <span>↗</span></a>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    <section class="section section-industries" id="industries">
        <div class="container industries-layout">
            <div class="industries-intro reveal">
                <p class="eyebrow eyebrow-light"><span></span>{{ data_get($content, 'industries.eyebrow') }}</p>
                <h2>{{ data_get($content, 'industries.title') }}</h2>
                <p>{{ data_get($content, 'industries.description') }}</p>
                <a class="text-link text-link-light" href="#contact">Talk to a sector specialist <span>→</span></a>
            </div>

            <div class="industry-list">
                @foreach (data_get($content, 'industries.items', []) as $index => $industry)
                    <article class="industry-row reveal">
                        <span class="industry-index">0{{ $index + 1 }}</span>
                        <div class="industry-text">
                            <h3>{{ data_get($industry, 'title') }}</h3>
                            <p>{{ data_get($industry, 'text') }}</p>
                        </div>
                        <span class="industry-arrow">↗</span>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    <section class="section section-approach" id="approach">
        <div class="container">
            <div class="section-heading centered-heading reveal">
                <p class="eyebrow"><span></span>{{ data_get($content, 'approach.eyebrow') }}</p>
                <h2>{{ data_get($content, 'approach.title') }}</h2>
                <p>{{ data_get($content, 'approach.description') }}</p>
            </div>
            <div class="approach-grid">
                @foreach (data_get($content, 'approach.steps', []) as $step)
                    <article class="approach-step reveal">
                        <div class="step-top">
                            <span>{{ data_get($step, 'number') }}</span>
                            <i></i>
                        </div>
                        <h3>{{ data_get($step, 'title') }}</h3>
                        <p>{{ data_get($step, 'text') }}</p>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    <section class="section section-work" id="work">
        <div class="container">
            <div class="section-heading split-heading reveal">
                <div>
                    <p class="eyebrow"><span></span>{{ data_get($content, 'work.eyebrow') }}</p>
                    <h2>{{ data_get($content, 'work.title') }}</h2>
                </div>
                <p>{{ data_get($content, 'work.description') }}</p>
            </div>

            <div class="work-grid">
                @foreach (data_get($content, 'work.items', []) as $index => $item)
                    <article class="work-card reveal">
                        <div class="work-image">
                            @if ($media('media.work_images.'.$index))
                                <img src="{{ $media('media.work_images.'.$index) }}" alt="" class="uploaded-fit-image">
                            @else
                                <div class="case-visual case-{{ $index + 1 }}" aria-hidden="true">
                                    <span class="case-line"></span>
                                    <span class="case-block block-one"></span>
                                    <span class="case-block block-two"></span>
                                    <span class="case-dot dot-one"></span>
                                    <span class="case-dot dot-two"></span>
                                </div>
                            @endif
                            <span class="case-category">{{ data_get($item, 'category') }}</span>
                        </div>
                        <div class="work-body">
                            <h3>{{ data_get($item, 'title') }}</h3>
                            <p>{{ data_get($item, 'text') }}</p>
                            <strong>{{ data_get($item, 'result') }}</strong>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    <section class="insight-band">
        <div class="container insight-grid">
            <div class="insight-symbol reveal" aria-hidden="true">
                @php($insightImage = $media('media.insight_image') ?: $media('media.brand_mark'))
                @if ($insightImage)
                    <img src="{{ $insightImage }}" alt="">
                @else
                    <span>A</span>
                @endif
            </div>
            <div class="insight-copy reveal reveal-delay-1">
                <p class="eyebrow eyebrow-light"><span></span>{{ data_get($content, 'insight.eyebrow') }}</p>
                <h2>{{ data_get($content, 'insight.title') }}</h2>
                <p>{{ data_get($content, 'insight.description') }}</p>
                <a class="button button-outline-light" href="{{ data_get($content, 'insight.button_url') }}">{{ data_get($content, 'insight.button_text') }} <span>→</span></a>
            </div>
        </div>
    </section>

    <section class="section section-testimonials">
        <div class="container">
            <div class="section-heading centered-heading reveal">
                <p class="eyebrow"><span></span>{{ data_get($content, 'testimonials.eyebrow') }}</p>
                <h2>{{ data_get($content, 'testimonials.title') }}</h2>
            </div>
            <div class="testimonial-grid">
                @foreach (data_get($content, 'testimonials.items', []) as $index => $testimonial)
                    <article class="testimonial-card reveal">
                        <span class="quote-mark">“</span>
                        <blockquote>{{ data_get($testimonial, 'quote') }}</blockquote>
                        <footer>
                            @if ($media('media.testimonial_avatars.'.$index))
                                <img src="{{ $media('media.testimonial_avatars.'.$index) }}" alt="" class="testimonial-avatar">
                            @else
                                <span class="avatar-fallback">{{ strtoupper(substr((string) data_get($testimonial, 'name'), 0, 1)) }}</span>
                            @endif
                            <div><strong>{{ data_get($testimonial, 'name') }}</strong><span>{{ data_get($testimonial, 'role') }}</span></div>
                        </footer>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    <section class="cta-section">
        <div class="container">
            <div class="cta-card reveal">
                <div>
                    <p class="eyebrow eyebrow-light"><span></span>{{ data_get($content, 'cta.eyebrow') }}</p>
                    <h2>{{ data_get($content, 'cta.title') }}</h2>
                    <p>{{ data_get($content, 'cta.description') }}</p>
                </div>
                <a class="button button-light" href="{{ data_get($content, 'cta.button_url') }}">{{ data_get($content, 'cta.button_text') }} <span>↗</span></a>
            </div>
        </div>
    </section>

    <section class="section section-contact" id="contact">
        <div class="container contact-grid">
            <div class="contact-copy reveal">
                <p class="eyebrow"><span></span>{{ data_get($content, 'contact.eyebrow') }}</p>
                <h2>{{ data_get($content, 'contact.title') }}</h2>
                <p class="lead">{{ data_get($content, 'contact.description') }}</p>

                <div class="contact-details">
                    <div><span>{{ data_get($content, 'contact.office_label') }}</span><strong>{{ data_get($content, 'contact.office') }}</strong></div>
                    <div><span>{{ data_get($content, 'contact.email_label') }}</span><a href="mailto:{{ data_get($content, 'contact.email') }}">{{ data_get($content, 'contact.email') }}</a></div>
                    <div><span>{{ data_get($content, 'contact.phone_label') }}</span><a href="tel:{{ $phoneHref }}">{{ data_get($content, 'contact.phone') }}</a></div>
                </div>

                <div class="contact-art" aria-hidden="true">
                    @if ($media('media.contact_image'))
                        <img src="{{ $media('media.contact_image') }}" alt="" class="uploaded-fit-image">
                    @else
                        <span class="contact-ring ring-one"></span>
                        <span class="contact-ring ring-two"></span>
                        <span class="contact-square square-one"></span>
                        <span class="contact-square square-two"></span>
                    @endif
                </div>
            </div>

            <div class="contact-form-card reveal reveal-delay-1">
                @if (session('success'))
                    <div class="form-alert form-alert-success" id="formSuccess">{{ session('success') }}</div>
                @endif
                @if ($errors->any())
                    <div class="form-alert form-alert-error">
                        <strong>Please review the highlighted fields.</strong>
                    </div>
                @endif

                <form method="POST" action="{{ route('contact.store') }}" novalidate>
                    @csrf
                    <div class="honeypot" aria-hidden="true"><label>Website<input type="text" name="website" tabindex="-1" autocomplete="off"></label></div>
                    <div class="form-grid">
                        <div class="form-field">
                            <label for="name">{{ data_get($content, 'contact.form.name_label') }}</label>
                            <input id="name" name="name" value="{{ old('name') }}" placeholder="{{ data_get($content, 'contact.form.name_placeholder') }}" required class="{{ $errors->has('name') ? 'is-invalid' : '' }}">
                            @error('name')<span class="field-error">{{ $message }}</span>@enderror
                        </div>
                        <div class="form-field">
                            <label for="email">{{ data_get($content, 'contact.form.email_label') }}</label>
                            <input id="email" type="email" name="email" value="{{ old('email') }}" placeholder="{{ data_get($content, 'contact.form.email_placeholder') }}" required class="{{ $errors->has('email') ? 'is-invalid' : '' }}">
                            @error('email')<span class="field-error">{{ $message }}</span>@enderror
                        </div>
                        <div class="form-field">
                            <label for="company">{{ data_get($content, 'contact.form.company_label') }}</label>
                            <input id="company" name="company" value="{{ old('company') }}" placeholder="{{ data_get($content, 'contact.form.company_placeholder') }}" class="{{ $errors->has('company') ? 'is-invalid' : '' }}">
                            @error('company')<span class="field-error">{{ $message }}</span>@enderror
                        </div>
                        <div class="form-field">
                            <label for="service">{{ data_get($content, 'contact.form.service_label') }}</label>
                            <select id="service" name="service" required class="{{ $errors->has('service') ? 'is-invalid' : '' }}">
                                <option value="">{{ data_get($content, 'contact.form.service_placeholder') }}</option>
                                @foreach (data_get($content, 'contact.form.service_options', []) as $option)
                                    <option value="{{ $option }}" @selected(old('service') === $option)>{{ $option }}</option>
                                @endforeach
                            </select>
                            @error('service')<span class="field-error">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="form-field">
                        <label for="message">{{ data_get($content, 'contact.form.message_label') }}</label>
                        <textarea id="message" name="message" rows="5" placeholder="{{ data_get($content, 'contact.form.message_placeholder') }}" required class="{{ $errors->has('message') ? 'is-invalid' : '' }}">{{ old('message') }}</textarea>
                        @error('message')<span class="field-error">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-submit-row">
                        <button class="button" type="submit">{{ data_get($content, 'contact.form.button_text') }} <span>↗</span></button>
                        <p>{{ data_get($content, 'contact.form.privacy_text') }}</p>
                    </div>
                </form>
            </div>
        </div>
    </section>
</main>

<footer class="site-footer">
    <div class="container footer-grid">
        <div class="footer-brand">
            @if ($media('media.footer_logo'))
                <img src="{{ $media('media.footer_logo') }}" alt="{{ data_get($content, 'brand.name') }}">
            @else
                <strong>{{ data_get($content, 'brand.name') }}</strong>
            @endif
            <p>{{ data_get($content, 'footer.description') }}</p>
            <span>{{ data_get($content, 'brand.tagline') }}</span>
        </div>
        <div class="footer-column">
            <h3>{{ data_get($content, 'footer.column_1_title') }}</h3>
            @foreach (data_get($content, 'footer.column_1_links', []) as $link)
                <a href="{{ data_get($link, 'url') }}">{{ data_get($link, 'label') }}</a>
            @endforeach
        </div>
        <div class="footer-column">
            <h3>{{ data_get($content, 'footer.column_2_title') }}</h3>
            @foreach (data_get($content, 'footer.column_2_links', []) as $link)
                <a href="{{ data_get($link, 'url') }}">{{ data_get($link, 'label') }}</a>
            @endforeach
        </div>
        <div class="footer-column footer-contact">
            <h3>Connect</h3>
            <a href="mailto:{{ data_get($content, 'contact.email') }}">{{ data_get($content, 'contact.email') }}</a>
            <a href="tel:{{ $phoneHref }}">{{ data_get($content, 'contact.phone') }}</a>
            <div class="social-links">
                @foreach (data_get($content, 'footer.social_links', []) as $social)
                    <a href="{{ data_get($social, 'url') }}" aria-label="{{ data_get($social, 'label') }}">{{ substr((string) data_get($social, 'label'), 0, 2) }}</a>
                @endforeach
            </div>
        </div>
    </div>
    <div class="container footer-bottom">
        <p>{{ str_replace('{year}', date('Y'), (string) data_get($content, 'footer.copyright')) }}</p>
        <div><a href="{{ data_get($content, 'footer.privacy_url') }}">{{ data_get($content, 'footer.privacy_label') }}</a><a href="{{ data_get($content, 'footer.terms_url') }}">{{ data_get($content, 'footer.terms_label') }}</a></div>
    </div>
</footer>
@endsection
