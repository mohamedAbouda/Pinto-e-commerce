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
          @if(Auth::guard('web')->check())
          @if(Auth::guard('web')->user()->roles()->first() && Auth::guard('web')->user()->roles()->first()->name == 'superAdmin' || Auth::guard('web')->user()->roles()->first() && Auth::guard('web')->user()->roles()->first()->name == 'admin')

         <!--  <li class="c-menu__item has-submenu {{ (request()->route()->getName() === 'dashboard.list.gift.cards') ? 'is-active' : '' }} ? 'is-active' : '' }}" data-toggle="tooltip" title="Gift Cards">
          <a href="{{route('dashboard.list.gift.cards')}}" style="text-decoration: none;">
            <div class="c-menu__item__inner">
              <i class="fa fa-binoculars"></i>
              <div class="c-menu-item__title">
                <span>{{trans('web.dashboard_sideBard_gift_cards')}}</span>
              </div>
            </div>
          </a>
                  </li> -->


         <li class="c-menu__item has-submenu {{ (request()->route()->getName() === 'dashboard.approved.reviews') ? 'is-active' : '' }} ? 'is-active' : '' }}" data-toggle="tooltip" title="Approved Reviews">
          <a href="{{route('dashboard.approved.reviews')}}" style="text-decoration: none;">
             <div class="c-menu__item__inner">
               <i class="fa fa-binoculars"></i>
               <div class="c-menu-item__title">
                 <span>{{trans('web.dashboard_sideBard_approved_reviews')}}</span>
               </div>
             </div>
           </a>
         </li>

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

   <li class="c-menu__item has-submenu {{ (request()->route()->getName() === 'dashboard.list.gift.cards') ? 'is-active' : '' }} ? 'is-active' : '' }}" data-toggle="tooltip" title="Gift Cards">
       <a href="{{route('dashboard.list.gift.cards')}}" style="text-decoration: none;">
           <div class="c-menu__item__inner">
               <i class="fa fa-binoculars"></i>
               <div class="c-menu-item__title">
                   <span>Gift Cards</span>
               </div>
           </div>
       </a>
   </li>
<!--    <li class="c-menu__item has-submenu {{ (request()->route()->getName() === 'dashboard.list.gift.cards') ? 'is-active' : '' }}" data-toggle="tooltip" title="{{ trans('web.sidebar_links_gift_cards') }}">
 <a href="{{route('dashboard.list.gift.cards')}}" style="text-decoration: none;">
     <div class="c-menu__item__inner">
         <i class="fa fa-binoculars"></i>
         <div class="c-menu-item__title">
             <span>{{ trans('web.sidebar_links_gift_cards') }}</span>
         </div>
     </div>
 </a>
</li> -->

<!--
   <li class="c-menu__item has-submenu {{ (request()->route()->getName() === 'dashboard.contact_messages.index') ? 'is-active' : '' }} ? 'is-active' : '' }}" data-toggle="tooltip" title="Contact Messages">
       <a href="{{route('dashboard.contact_messages.index')}}" style="text-decoration: none;">
           <div class="c-menu__item__inner">
               <i class="fa fa-binoculars"></i>
               <div class="c-menu-item__title">
                   <span>Contact Messages</span>
               </div>
           </div>
       </a>
   </li>

   <li class="c-menu__item has-submenu {{ (request()->route()->getName() === 'dashboard.storelocations.index') ? 'is-active' : '' }} ? 'is-active' : '' }}" data-toggle="tooltip" title="Store Locations">
       <a href="{{route('dashboard.storelocations.index')}}" style="text-decoration: none;">
           <div class="c-menu__item__inner">
               <i class="fa fa-binoculars"></i>
               <div class="c-menu-item__title">
                   <span>Store Locations</span>
               </div>
           </div>
       </a>
     </li> -->
<!--                     <li class="c-menu__item has-submenu {{ (request()->route()->getName() === 'dashboard.merchants.index') ? 'is-active' : '' }} ? 'is-active' : '' }}" data-toggle="tooltip" title="Merchants">

<li class="c-menu__item has-submenu {{ (request()->route()->getName() === 'dashboard.admins.index') ? 'is-active' : '' }}" data-toggle="tooltip" title="{{ trans('web.sidebar_links_admins') }}">
    <a href="{{route('dashboard.admins.index')}}" style="text-decoration: none;">
        <div class="c-menu__item__inner">
            <i class="fa fa-binoculars"></i>
            <div class="c-menu-item__title">
                <span>{{ trans('web.sidebar_links_admins') }}</span>
            </div>
        </div>
    </a>
</li>



<li class="c-menu__item has-submenu {{ (request()->route()->getName() === 'dashboard.contact_messages.index') ? 'is-active' : '' }}" data-toggle="tooltip" title="{{ trans('web.sidebar_links_contact_messages') }}">
    <a href="{{route('dashboard.contact_messages.index')}}" style="text-decoration: none;">
        <div class="c-menu__item__inner">
            <i class="fa fa-binoculars"></i>
            <div class="c-menu-item__title">
                <span>{{ trans('web.sidebar_links_contact_messages') }}</span>
            </div>
        </div>
    </a>
</li>
<li class="c-menu__item has-submenu {{ (request()->route()->getName() === 'dashboard.storelocations.index') ? 'is-active' : '' }}" data-toggle="tooltip" title="{{ trans('web.sidebar_links_store_locations') }}">
    <a href="{{route('dashboard.storelocations.index')}}" style="text-decoration: none;">
        <div class="c-menu__item__inner">
            <i class="fa fa-binoculars"></i>
            <div class="c-menu-item__title">
                <span>{{ trans('web.sidebar_links_store_locations') }}</span>
            </div>
        </div>
    </a>

                </li> -->
                <li class="c-menu__item has-submenu {{ (request()->route()->getName() === 'dashboard.offers.index') ? 'is-active' : '' }} ? 'is-active' : '' }}" data-toggle="tooltip" title="Offers">
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
                   </li>
                    <li class="c-menu__item has-submenu {{ (request()->route()->getName() === 'dashboard.merchants.index') ? 'is-active' : '' }}" data-toggle="tooltip" title="{{ trans('web.sidebar_links_merchants') }}">
                        <a href="{{route('dashboard.merchants.index')}}" style="text-decoration: none;">
                            <div class="c-menu__item__inner">
                                <i class="fa fa-binoculars"></i>
                                <div class="c-menu-item__title">
                                    <span>{{ trans('web.sidebar_links_merchants') }}</span>
                                </div>
                            </div>
                        </a>
                    </li>
                    @endif
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
                    <li class="c-menu__item has-submenu {{ strpos(request()->route()->getName(), 'dashboard.brands.') !== false ? 'is-active' : '' }}" data-toggle="tooltip" title="{{ trans('web.sidebar_links_brands') }}">
                        <a href="{{route('dashboard.brands.index')}}" style="text-decoration: none;">
                            <div class="c-menu__item__inner">
                                <i class="fa fa-apple"></i>
                                <div class="c-menu-item__title">
                                    <span>{{ trans('web.sidebar_links_brands') }}</span>
                                </div>
                            </div>
                        </a>
                    </li>
              <!--       <li class="c-menu__item has-submenu {{ (request()->route()->getName() === 'dashboard.sizes.index') ? 'is-active' : '' }}" data-toggle="tooltip" title="Sizes">
                  <a href="{{route('dashboard.sizes.index')}}" style="text-decoration: none;">
                      <div class="c-menu__item__inner">
                          <i class="fa fa-expand"></i>
                          <div class="c-menu-item__title">
                              <span>Sizes</span>
                          </div>
                      </div>
                  </a>
              </li>

              <li class="c-menu__item has-submenu {{ (request()->route()->getName() === 'dashboard.brands.index') ? 'is-active' : '' }}" data-toggle="tooltip" title="Brands">
                  <a href="{{route('dashboard.brands.index')}}" style="text-decoration: none;">
                      <div class="c-menu__item__inner">
                          <i class="fa fa-apple"></i>
                          <div class="c-menu-item__title">
                              <span>Brands</span>
                          </div>
                      </div>
                  </a>
              </li>

              <li class="c-menu__item has-submenu {{ (request()->route()->getName() === 'dashboard.colors.index') ? 'is-active' : '' }}" data-toggle="tooltip" title="Colors">
                  <a href="{{route('dashboard.colors.index')}}" style="text-decoration: none;">
                      <div class="c-menu__item__inner">
                          <i class="fa fa-paint-brush"></i>
                          <div class="c-menu-item__title">
                              <span>Colors</span>
                          </div>
                      </div>
                  </a>
              </li>

                 <li class="c-menu__item has-submenu {{ (request()->route()->getName() === 'dashboard.governorates.index') ? 'is-active' : '' }}" data-toggle="tooltip" title="Colors">
                  <a href="{{route('dashboard.governorates.index')}}" style="text-decoration: none;">
                      <div class="c-menu__item__inner">
                          <i class="fa fa-paint-brush"></i>
                          <div class="c-menu-item__title">
                              <span>Governorates</span>
                          </div>
                      </div>
                  </a>
              </li>

              <li class="c-menu__item has-submenu {{ (request()->route()->getName() === 'dashboard.delivery_options.index') ? 'is-active' : '' }}" data-toggle="tooltip" title="Delivery options">
                  <a href="{{route('dashboard.delivery_options.index')}}" style="text-decoration: none;">
                      <div class="c-menu__item__inner">
                          <i class="fa fa-motorcycle"></i>
                          <div class="c-menu-item__title">
                              <span>Delivery options</span>
                          </div>
                      </div>
                  </a>
              </li>

              <li class="c-menu__item has-submenu {{ (request()->route()->getName() === 'dashboard.payment_methods.index') ? 'is-active' : '' }}" data-toggle="tooltip" title="Payment methods">
                  <a href="{{route('dashboard.payment_methods.index')}}" style="text-decoration: none;">
                      <div class="c-menu__item__inner">
                          <i class="fa fa-credit-card"></i>
                          <div class="c-menu-item__title">
                              <span>Payment methods</span>
                          </div>
                      </div>
                  </a>
                </li> -->
                    {{--
                        <li class="c-menu__item has-submenu {{ (request()->route()->getName() === 'dashboard.subscribers.index') ? 'is-active' : '' }}" data-toggle="tooltip" title="Subscribers">
                            <a href="{{route('dashboard.subscribers.index')}}" style="text-decoration: none;">
                                <div class="c-menu__item__inner">
                                    <i class="fa fa-feed"></i>
                                    <div class="c-menu-item__title">
                                        <span>Subscribers</span>
                                    </div>
                                </div>
                            </a>

                        </li> --}}
         <!--                <li class="c-menu__item has-submenu {{ (request()->route()->getName() === 'dashboard.offers.index') ? 'is-active' : '' }} ? 'is-active' : '' }}" data-toggle="tooltip" title="Offers">
             <a href="{{route('dashboard.offers.index')}}" style="text-decoration: none;">
                 <div class="c-menu__item__inner">
                     <i class="fa fa-files-o"></i>
                     <div class="c-menu-item__title">
                         <span>Offers</span>
                     </div>
                 </div>
             </a>
         </li>

         <li class="c-menu__item has-submenu {{ (request()->route()->getName() === 'dashboard.sliders.index') ? 'is-active' : '' }} ? 'is-active' : '' }}" data-toggle="tooltip" title="Sliders">
             <a href="{{route('dashboard.sliders.index')}}" style="text-decoration: none;">
                 <div class="c-menu__item__inner">
                     <i class="fa fa-files-o"></i>
                     <div class="c-menu-item__title">
                         <span>Sliders</span>
                     </div>
                 </div>
             </a>
           </li> -->

           @else

           <li class="c-menu__item has-submenu {{ (request()->route()->getName() === 'dashboard.merchant.get.profile.edit') ? 'is-active' : '' }}" data-toggle="tooltip" title="Settings">
            <a href="{{route('dashboard.merchant.get.profile.edit')}}" style="text-decoration: none;">
              <div class="c-menu__item__inner">
                <i class="fa fa-address-card"></i>
                <div class="c-menu-item__title">
                  <span>Settings</span>
                </div>
              </div>
            </a>
          </li>
     <li class="c-menu__item has-submenu {{ (request()->route()->getName() === 'dashboard.gift_cards.index') ? 'is-active' : '' }} ? 'is-active' : '' }}" data-toggle="tooltip" title="Gift Cards">
         <a href="{{route('dashboard.gift_cards.index')}}" style="text-decoration: none;">
           <div class="c-menu__item__inner">
             <i class="fa fa-files-o"></i>
             <div class="c-menu-item__title">
               <span>Gift Cards</span>
             </div>
           </div>
         </a>
       </li>


          @endif

          @if(Auth::guard('merchant')->check())
          <li class="c-menu__item has-submenu {{ (request()->route()->getName() === 'dashboard.merchant_admins.index') ? 'is-active' : '' }}" data-toggle="tooltip" title="Merchants Admins">
            <a href="{{route('dashboard.merchant_admins.index')}}" style="text-decoration: none;">
              <div class="c-menu__item__inner">
                <i class="fa fa-group"></i>
                <div class="c-menu-item__title">
                  <span>My admins</span>
                </div>
              </div>
            </a>
          </li>
          @endif

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

          @if(Auth::guard('merchant')->check())
          <li class="c-menu__item has-submenu {{ (request()->route()->getName() === 'dashboard.offers.index') ? 'is-active' : '' }}" data-toggle="tooltip" title="Offers">
            <a href="{{route('dashboard.offers.index')}}" style="text-decoration: none;">
              <div class="c-menu__item__inner">
                <i class="fa fa-briefcase"></i>
                <div class="c-menu-item__title">
                  <span>Offers</span>
                </div>
              </div>
            </a>
          </li>
          <li class="c-menu__item has-submenu {{ (request()->route()->getName() === 'dashboard.branches.index') ? 'is-active' : '' }}" data-toggle="tooltip" title="Branches">
            <a href="{{route('dashboard.branches.index')}}" style="text-decoration: none;">
              <div class="c-menu__item__inner">
                <i class="fa fa-shopping-basket"></i>
                <div class="c-menu-item__title">
                  <span>Branches</span>
                </div>
              </div>
            </a>
          </li>

                 <!--    <li class="c-menu__item has-submenu {{ (request()->route()->getName() === 'dashboard.sizes.index') ? 'is-active' : '' }}" data-toggle="tooltip" title="{{ trans('web.sidebar_links_sizes') }}">
                     <a href="{{route('dashboard.sizes.index')}}" style="text-decoration: none;">
                         <div class="c-menu__item__inner">
                             <i class="fa fa-expand"></i>
                             <div class="c-menu-item__title">
                                 <span>{{ trans('web.sidebar_links_sizes') }}</span>
                             </div>
                         </div>
                     </a>
                 </li>

                 <li class="c-menu__item has-submenu {{ (request()->route()->getName() === 'dashboard.colors.index') ? 'is-active' : '' }}" data-toggle="tooltip" title="{{ trans('web.sidebar_links_colors') }}">
                     <a href="{{route('dashboard.colors.index')}}" style="text-decoration: none;">
                         <div class="c-menu__item__inner">
                             <i class="fa fa-paint-brush"></i>
                             <div class="c-menu-item__title">
                                 <span>{{ trans('web.sidebar_links_colors') }}</span>
                             </div>
                         </div>
                     </a>
                 </li>
                 <li class="c-menu__item has-submenu {{ (request()->route()->getName() === 'dashboard.delivery_options.index') ? 'is-active' : '' }}" data-toggle="tooltip" title="{{ trans('web.sidebar_links_delivery_options') }}">
                     <a href="{{route('dashboard.delivery_options.index')}}" style="text-decoration: none;">
                         <div class="c-menu__item__inner">
                             <i class="fa fa-motorcycle"></i>
                             <div class="c-menu-item__title">
                                 <span>{{ trans('web.sidebar_links_delivery_options') }}</span>
                             </div>
                         </div>
                     </a>
                 </li>
                -->



                        @endif



                        {{--           <li class="c-menu__item has-submenu {{ (request()->route()->getName() === 'dashboard.key_words.index') ? 'is-active' : '' }}" data-toggle="tooltip" title="Key Words">
                            <a href="{{route('dashboard.key_words.index')}}" style="text-decoration: none;">
                                <div class="c-menu__item__inner">
                                    <i class="fa fa-feed"></i>
                                    <div class="c-menu-item__title">
                                        <span>Key Words</span>
                                    </div>
                                </div>
                            </a>
                        </li>
                        --}}
                        {{--         <li class="c-menu__item has-submenu" data-toggle="tooltip" title="Leads">

                    <li class="c-menu__item has-submenu {{ (request()->route()->getName() === 'dashboard.sliders.index') ? 'is-active' : '' }}" data-toggle="tooltip" title="{{ trans('web.sidebar_links_sliders') }}">
                        <a href="{{route('dashboard.sliders.index')}}" style="text-decoration: none;">

                            <div class="c-menu__item__inner">
                                <i class="fa fa-files-o"></i>
                                <div class="c-menu-item__title">
                                    <span>{{ trans('web.sidebar_links_sliders') }}</span>
                                </div>
                            </div>
                        </a>
                    </li>
                    @else
                    <li class="c-menu__item has-submenu {{ (request()->route()->getName() === 'dashboard.merchant.get.profile.edit') ? 'is-active' : '' }}" data-toggle="tooltip" title="{{ trans('web.sidebar_links_settings') }}">
                        <a href="{{route('dashboard.merchant.get.profile.edit')}}" style="text-decoration: none;">
                            <div class="c-menu__item__inner">
                                <i class="fa fa-address-card"></i>
                                <div class="c-menu-item__title">
                                    <span>{{ trans('web.sidebar_links_settings') }}</span>
                                </div>
                            </div>
                        </a>
                    </li>
                    <li class="c-menu__item has-submenu {{ (request()->route()->getName() === 'dashboard.gift_cards.index') ? 'is-active' : '' }}" data-toggle="tooltip" title="{{ trans('web.sidebar_links_gift_cards') }}">
                        <a href="{{route('dashboard.gift_cards.index')}}" style="text-decoration: none;">
                            <div class="c-menu__item__inner">
                                <i class="fa fa-files-o"></i>
                                <div class="c-menu-item__title">
                                    <span>{{ trans('web.sidebar_links_gift_cards') }}</span>
                                </div>
                            </div>
                        </a>
                    </li>
                    @endif

                    @if(Auth::guard('merchant')->check())
                    <li class="c-menu__item has-submenu {{ (request()->route()->getName() === 'dashboard.merchant_admins.index') ? 'is-active' : '' }}" data-toggle="tooltip" title="{{ trans('web.sidebar_links_merchant_admins') }}">
                        <a href="{{route('dashboard.merchant_admins.index')}}" style="text-decoration: none;">
                            <div class="c-menu__item__inner">
                                <i class="fa fa-group"></i>
                                <div class="c-menu-item__title">
                                    <span>{{ trans('web.sidebar_links_merchant_admins') }}</span>
                                </div>
                            </div>
                        </a>
                    </li>
                    @endif
                    <li class="c-menu__item has-submenu {{ (request()->route()->getName() === 'dashboard.products.index') ? 'is-active' : '' }}" data-toggle="tooltip" title="{{ trans('web.sidebar_links_products') }}">
                        <a href="{{route('dashboard.products.index')}}" style="text-decoration: none;">
                            <div class="c-menu__item__inner">
                                <i class="fa fa-briefcase"></i>
                                <div class="c-menu-item__title">
                                    <span>{{ trans('web.sidebar_links_products') }}</span>
                                </div>
                            </div>
                        </a>
                    </li>
                    @if(Auth::guard('merchant')->check())
                    <li class="c-menu__item has-submenu {{ (request()->route()->getName() === 'dashboard.offers.index') ? 'is-active' : '' }}" data-toggle="tooltip" title="{{ trans('web.sidebar_links_offers') }}">
                        <a href="{{route('dashboard.offers.index')}}" style="text-decoration: none;">
                            <div class="c-menu__item__inner">
                                <i class="fa fa-briefcase"></i>
                                <div class="c-menu-item__title">
                                    <span>{{ trans('web.sidebar_links_offers') }}</span>
                                </div>
                            </div>
                        </a>
                    </li>
                    <li class="c-menu__item has-submenu {{ (request()->route()->getName() === 'dashboard.branches.index') ? 'is-active' : '' }}" data-toggle="tooltip" title="{{ trans('web.sidebar_links_branches') }}">
                        <a href="{{route('dashboard.branches.index')}}" style="text-decoration: none;">
                            <div class="c-menu__item__inner">
                                <i class="fa fa-shopping-basket"></i>
                                <div class="c-menu-item__title">
                                    <span>{{ trans('web.sidebar_links_branches') }}</span>
                                </div>
                            </div>
                        </a>
                    </li>
                    @endif

                    <li class="c-menu__item has-submenu {{ (request()->route()->getName() === 'dashboard.corporate_deals.index') ? 'is-active' : '' }}" data-toggle="tooltip" title="{{ trans('web.sidebar_links_corporate_deals') }}">
                        <a href="{{route('dashboard.corporate_deals.index')}}" style="text-decoration: none;">
                            <div class="c-menu__item__inner">
                                <i class="fa fa-briefcase"></i>
                                <div class="c-menu-item__title">
                                    <span>{{ trans('web.sidebar_links_corporate_deals') }}</span>
                                </div>
                            </div>
                        </a>
                    </li>
                    --}}

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
                    <li class="c-menu__item has-submenu {{ (request()->route()->getName() === 'dashboard.corporate_deals.index') ? 'is-active' : '' }}" data-toggle="tooltip" title="Corporate Deals">
                      <a href="{{route('dashboard.corporate_deals.index')}}" style="text-decoration: none;">
                       <div class="c-menu__item__inner">
                        <i class="fa fa-expand"></i>
                        <div class="c-menu-item__title">
                          <span>{{ trans('web.sidebar_links_corporate_deals') }}</span>
                        </div>
                      </div>
                    </a>
                  </li>
                </ul>
              </nav>
            </div>
          </div>
        </header>
