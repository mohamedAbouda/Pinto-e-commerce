<header id="sidebar">
    <div class="l-sidebar" id="side">
        <div class="logo ">
            <div class="logo__txt ">
                <a href="#">
                    <img src="{{ asset('assets/panel-assets/images/icons/01_icon.png') }}" class="img-responsive hamburger-toggle js-hamburger" />
                </a>
            </div>
        </div>
        <div class="l-sidebar__content">
            <nav class="c-menu js-menu">
                <ul class="u-list">
                    <li class="c-menu__item {{ (request()->route()->getName() === 'dashboard.index') ? 'is-active' : '' }}" data-toggle="tooltip" title="{{ trans('web.sidebar_links_dashboard') }}">
                        <a href="{{ route('dashboard.index') }}">
                            <div class="c-menu__item__inner">
                                <i class="fa fa-dashboard"></i>
                                <div class="c-menu-item__title">
                                    <span>
                                        {{ trans('web.sidebar_links_dashboard') }}
                                    </span>
                                </div>
                            </div>
                        </a>
                    </li>

                    <!-- <li class="c-menu__item has-submenu {{ (request()->route()->getName() === 'dashboard.approved.reviews') ? 'is-active' : '' }} ? 'is-active' : '' }}" data-toggle="tooltip" title="Approved Reviews">
                        <a href="{{route('dashboard.approved.reviews')}}" style="text-decoration: none;">
                            <div class="c-menu__item__inner">
                                <i class="fa fa-binoculars"></i>
                                <div class="c-menu-item__title">
                                    <span>{{trans('web.dashboard_sideBard_approved_reviews')}}</span>
                                </div>
                            </div>
                        </a>
                    </li> -->

                    <li class="c-menu__item has-submenu {{ (request()->route()->getName() === 'dashboard.admins.index') ? 'is-active' : '' }} ? 'is-active' : '' }}" data-toggle="tooltip" title="Admins">
                        <a href="{{route('dashboard.admins.index')}}" style="text-decoration: none;">
                            <div class="c-menu__item__inner">
                                <i class="fa fa-binoculars"></i>
                                <div class="c-menu-item__title">
                                    <span>Admins</span>
                                </div>
                            </div>
                        </a>
                    </li>

                    <!-- <li class="c-menu__item has-submenu {{ (request()->route()->getName() === 'dashboard.offers.index') ? 'is-active' : '' }} ? 'is-active' : '' }}" data-toggle="tooltip" title="Offers">
                        <a href="{{route('dashboard.offers.index')}}" style="text-decoration: none;">
                            <div class="c-menu__item__inner">
                                <i class="fa fa-files-o"></i>
                                <div class="c-menu-item__title">
                                    <span>{{trans('web.dashboard_sideBard_offers')}}</span>
                                </div>
                            </div>
                        </a>
                    </li>
                    <li class="c-menu__item has-submenu {{ (request()->route()->getName() === 'dashboard.storelocations.index') ? 'is-active' : '' }} ? 'is-active' : '' }}" data-toggle="tooltip" title="Store Locations">
                        <a href="{{route('dashboard.storelocations.index')}}" style="text-decoration: none;">
                            <div class="c-menu__item__inner">
                                <i class="fa fa-binoculars"></i>
                                <div class="c-menu-item__title">
                                    <span>{{trans('web.dashboard_sideBard_store_locations')}}</span>
                                </div>
                            </div>
                        </a>
                    </li> -->
                    <li class="c-menu__item has-submenu {{ strpos(request()->route()->getName(), 'dashboard.users.') !== false ? 'is-active' : '' }}" data-toggle="tooltip" title="{{ trans('web.sidebar_links_users') }}">
                        <a href="{{route('dashboard.users.index')}}" style="text-decoration: none;">
                            <div class="c-menu__item__inner">
                                <i class="fa fa-group"></i>
                                <div class="c-menu-item__title">
                                    <span>{{ trans('web.sidebar_links_users') }}</span>
                                </div>
                            </div>
                        </a>
                    </li>
                    <li class="c-menu__item has-submenu {{ strpos(request()->route()->getName(), 'dashboard.categories.') !== false ? 'is-active' : '' }}" data-toggle="tooltip" title="{{ trans('web.sidebar_links_sections') }}">
                        <a href="{{route('dashboard.categories.index')}}" style="text-decoration: none;">
                            <div class="c-menu__item__inner">
                                <i class="fa fa-files-o"></i>
                                <div class="c-menu-item__title">
                                    <span>{{ trans('web.sidebar_links_sections') }}</span>
                                </div>
                            </div>
                        </a>
                    </li>
                    <li class="c-menu__item has-submenu {{ strpos(request()->route()->getName(), 'dashboard.subCategories.') !== false ? 'is-active' : '' }}" data-toggle="tooltip" title="{{ trans('web.sidebar_links_categories') }}">
                        <a href="{{route('dashboard.subCategories.index')}}" style="text-decoration: none;">
                            <div class="c-menu__item__inner">
                                <i class="fa fa-files-o"></i>
                                <div class="c-menu-item__title">
                                    <span>{{ trans('web.sidebar_links_categories') }}</span>
                                </div>
                            </div>
                        </a>
                    </li>
                    <li class="c-menu__item has-submenu {{  strpos(request()->route()->getName(), 'dashboard.about.') !== false ? 'is-active' : '' }}" data-toggle="tooltip" title="{{ trans('web.sidebar_links_about') }}">
                        <a href="{{route('dashboard.about.index')}}" style="text-decoration: none;">
                            <div class="c-menu__item__inner">
                                <i class="fa fa-file"></i>
                                <div class="c-menu-item__title">
                                    <span>{{ trans('web.sidebar_links_about') }}</span>
                                </div>
                            </div>
                        </a>
                    </li>
                    <li class="c-menu__item has-submenu {{  strpos(request()->route()->getName(), 'dashboard.policy.') !== false ? 'is-active' : '' }}" data-toggle="tooltip" title="{{ trans('web.sidebar_links_policy') }}">
                        <a href="{{route('dashboard.policy.index')}}" style="text-decoration: none;">
                            <div class="c-menu__item__inner">
                                <i class="fa fa-eye"></i>
                                <div class="c-menu-item__title">
                                    <span>{{ trans('web.sidebar_links_policy') }}</span>
                                </div>
                            </div>
                        </a>
                    </li>
                    <li class="c-menu__item has-submenu {{  strpos(request()->route()->getName(), 'dashboard.shipping.') !== false ? 'is-active' : '' }}" data-toggle="tooltip" title="Shipping & return Policy">
                        <a href="{{route('dashboard.shipping.index')}}" style="text-decoration: none;">
                            <div class="c-menu__item__inner">
                                <i class="fa fa-eye"></i>
                                <div class="c-menu-item__title">
                                    <span>Shipping & return Policy</span>
                                </div>
                            </div>
                        </a>
                    </li>
                    <li class="c-menu__item has-submenu {{  strpos(request()->route()->getName(), 'dashboard.blog.') !== false ? 'is-active' : '' }}" data-toggle="tooltip" title="Blog">
                        <a href="{{route('dashboard.blog.index')}}" style="text-decoration: none;">
                            <div class="c-menu__item__inner">
                                <i class="fa fa-wordpress"></i>
                                <div class="c-menu-item__title">
                                    <span>Blog</span>
                                </div>
                            </div>
                        </a>
                    </li>
                    <li class="c-menu__item has-submenu {{  strpos(request()->route()->getName(), 'dashboard.terms.') !== false ? 'is-active' : '' }}" data-toggle="tooltip" title="{{ trans('web.sidebar_links_terms') }}">
                        <a href="{{route('dashboard.terms.index')}}" style="text-decoration: none;">
                            <div class="c-menu__item__inner">
                                <i class="fa fa-paperclip"></i>
                                <div class="c-menu-item__title">
                                    <span>{{ trans('web.sidebar_links_terms') }}</span>
                                </div>
                            </div>
                        </a>
                    </li>
                    <li class="c-menu__item has-submenu {{ strpos(request()->route()->getName(), 'dashboard.contact.') !== false ? 'is-active' : '' }}" data-toggle="tooltip" title="{{ trans('web.sidebar_links_contact') }}">
                        <a href="{{route('dashboard.contact.index')}}" style="text-decoration: none;">
                            <div class="c-menu__item__inner">
                                <i class="fa fa-at"></i>
                                <div class="c-menu-item__title">
                                    <span>{{ trans('web.sidebar_links_contact') }}</span>
                                </div>
                            </div>
                        </a>
                    </li>
                    <li class="c-menu__item has-submenu {{ strpos(request()->route()->getName(), 'dashboard.contact_messages.') !== false ? 'is-active' : '' }}" data-toggle="tooltip" title="Contact messages">
                        <a href="{{route('dashboard.contact_messages.index')}}" style="text-decoration: none;">
                            <div class="c-menu__item__inner">
                                <i class="fa fa-at"></i>
                                <div class="c-menu-item__title">
                                    <span>Contact messages</span>
                                </div>
                            </div>
                        </a>
                    </li>

                    <li class="c-menu__item has-submenu {{ strpos(request()->route()->getName(), 'dashboard.sliders.') !== false ? 'is-active' : '' }}" data-toggle="tooltip" title="{{ trans('web.sidebar_links_sliders') }}">
                        <a href="{{route('dashboard.sliders.index')}}" style="text-decoration: none;">

                            <div class="c-menu__item__inner">
                                <i class="fa fa-image"></i>
                                <div class="c-menu-item__title">
                                    <span>{{ trans('web.sidebar_links_sliders') }}</span>
                                </div>
                            </div>
                        </a>
                    </li>
                    <!-- <li class="c-menu__item has-submenu {{ strpos(request()->route()->getName(), 'dashboard.brands.') !== false ? 'is-active' : '' }}" data-toggle="tooltip" title="{{ trans('web.sidebar_links_brands') }}">
                        <a href="{{route('dashboard.brands.index')}}" style="text-decoration: none;">
                            <div class="c-menu__item__inner">
                                <i class="fa fa-apple"></i>
                                <div class="c-menu-item__title">
                                    <span>{{ trans('web.sidebar_links_brands') }}</span>
                                </div>
                            </div>
                        </a>
                    </li> -->

                    <!-- <li class="c-menu__item has-submenu {{ (request()->route()->getName() === 'dashboard.gift_cards.index') ? 'is-active' : '' }} ? 'is-active' : '' }}" data-toggle="tooltip" title="Gift Cards">
                        <a href="{{route('dashboard.gift_cards.index')}}" style="text-decoration: none;">
                            <div class="c-menu__item__inner">
                                <i class="fa fa-files-o"></i>
                                <div class="c-menu-item__title">
                                    <span>Gift Cards</span>
                                </div>
                            </div>
                        </a>
                    </li> -->

                    <li class="c-menu__item has-submenu {{ (request()->route()->getName() === 'dashboard.products.index') ? 'is-active' : '' }}" data-toggle="tooltip" title="Products">
                        <a href="{{route('dashboard.products.index')}}" style="text-decoration: none;">
                            <div class="c-menu__item__inner">
                                <i class="fa fa-briefcase"></i>
                                <div class="c-menu-item__title">
                                    <span>{{trans('web.dashboard_sideBard_products')}}</span>
                                </div>
                            </div>
                        </a>
                    </li>

                    <li class="c-menu__item has-submenu {{ (request()->route()->getName() === 'dashboard.orders.index') ? 'is-active' : '' }}" data-toggle="tooltip" title="{{ trans('web.sidebar_links_orders') }}">
                        <a href="{{route('dashboard.orders.index')}}" style="text-decoration: none;">
                            <div class="c-menu__item__inner">
                                <i class="fa fa-feed"></i>
                                <div class="c-menu-item__title">
                                    <span>{{ trans('web.sidebar_links_orders') }}</span>
                                </div>
                            </div>
                        </a>
                    </li>
                    <!-- <li class="c-menu__item has-submenu {{ (request()->route()->getName() === 'dashboard.corporate_deals.index') ? 'is-active' : '' }}" data-toggle="tooltip" title="Corporate Deals">
                        <a href="{{route('dashboard.corporate_deals.index')}}" style="text-decoration: none;">
                            <div class="c-menu__item__inner">
                                <i class="fa fa-expand"></i>
                                <div class="c-menu-item__title">
                                    <span>{{ trans('web.sidebar_links_corporate_deals') }}</span>
                                </div>
                            </div>
                        </a>
                    </li> -->
                </ul>
            </nav>
        </div>
    </div>
</header>
