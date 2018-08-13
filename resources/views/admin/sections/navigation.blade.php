<div class="col-md-3 left_col">
  <div class="left_col scroll-view">
    <div class="navbar nav_title" style="border: 0;">
      <a href="{{ route('admin.dashboard') }}" class="site_title">
        <span>{{ config('app.name') }}</span>
      </a>
    </div>

    <div class="clearfix"></div>

    <!-- menu profile quick info -->
    <div class="profile clearfix">
      <div class="profile_pic">
        <img src="{{ auth()->user()->avatar }}" alt="..." class="img-circle profile_img">
      </div>
      <div class="profile_info">
        <h2>{{ auth()->user()->name }}</h2>
      </div>
    </div>
    <!-- /menu profile quick info -->

    <br/>

    <!-- sidebar menu -->
    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
      <div class="menu_section">
        <h3>{{ __('views.backend.section.navigation.sub_header_0') }}</h3>
        <ul class="nav side-menu">
          <li>
            <a href="{{ route('admin.dashboard') }}">
              <i class="fa fa-home" aria-hidden="true"></i>
              {{ __('views.backend.section.navigation.menu_0_1') }}
            </a>
          </li>
        </ul>
      </div>
      <div class="menu_section">
        <h3>{{ __('views.backend.section.navigation.sub_header_2') }}</h3>

        <ul class="nav side-menu">
          <li>
            <a>
              <i class="fa fa-list"></i>
              {{ __('views.backend.section.navigation.products') }}
              <span class="fa fa-chevron-down"></span>
            </a>
            <ul class="nav child_menu">
              <li>
                <a href="{{ route('stockentry.instant') }}">
                  {{ __('views.backend.section.navigation.instant_entry') }}
                </a>
              </li>
              <li>
                <a href="{{ route('products.create') }}">
                  {{ __('views.backend.section.navigation.products_create') }}
                </a>
              </li>
              <li>
                <a href="{{ route('products.action') }}">
                  {{ __('views.backend.section.navigation.product_action') }}
                </a>
              </li>
              <li>
                <a href="{{ route('products.index') }}">
                  {{ __('views.backend.section.navigation.products_index') }}
                </a>
              </li>



            </ul>
          </li>
        </ul>

        <ul class="nav side-menu">
          <li>
            <a>
              <i class="fa fa-list"></i>
              {{ __('views.backend.section.navigation.menu_categories') }}
              <span class="fa fa-chevron-down"></span>
            </a>
            <ul class="nav child_menu">
              <li>
                <a href="{{ route('categories.create') }}">
                  {{ __('views.backend.section.navigation.menu_categories_create') }}
                </a>
              </li>
              <li>
                <a href="{{ route('categories.index') }}">
                  {{ __('views.backend.section.navigation.menu_categories_index') }}
                </a>
              </li>

            </ul>
          </li>
        </ul>

        <ul class="nav side-menu">
          <li>
            <a>
              <i class="fa fa-list"></i>
              {{ __('views.backend.section.navigation.menu_sales') }}
              <span class="fa fa-chevron-down"></span>
            </a>
            <ul class="nav child_menu">
              <li>
                <a href="{{ route('sales.create') }}">
                  {{ __('views.backend.section.navigation.menu_sales_create') }}
                </a>
              </li>
              <li>
                <a href="{{ route('sales.return') }}">
                  {{ __('views.backend.section.navigation.menu_sales_return') }}
                </a>
              </li>
              <li>
                <a href="{{ route('sales.reportset') }}">
                  {{ __('views.backend.section.navigation.menu_sales_report') }}

                </a>
              </li>



            </ul>
          </li>
        </ul>

        <ul class="nav side-menu">
          <li>
            <a>
              <i class="fa fa-list"></i>
              {{ __('views.backend.section.navigation.menu_stocks') }}
              <span class="fa fa-chevron-down"></span>
            </a>

            <ul class="nav child_menu">
              <li>
                <a href="{{ route('products.action') }}">
                  {{ __('views.backend.section.navigation.product_action') }}
                </a>
              </li>

              <li>
                <a href="{{ route('stocks.reportset') }}">
                  {{ __('views.backend.section.navigation.menu_stocks_report') }}
                </a>
              </li>

            </ul>
          </li>
        </ul>

        <ul class="nav side-menu">
          <li>
            <a>
              <i class="fa fa-list"></i>
              {{ __('views.backend.section.navigation.menu_attributes') }}
              <span class="fa fa-chevron-down"></span>
            </a>
            <ul class="nav child_menu">
              <li>
                <a href="{{ route('attributes.create') }}">
                  {{ __('views.backend.section.navigation.menu_attributes_create') }}
                </a>
              </li>
              <li>
                <a href="{{ route('attributes.index') }}">
                  {{ __('views.backend.section.navigation.menu_attributes_report') }}
                </a>
              </li>

            </ul>
          </li>
        </ul>
      </div>
      <div class="menu_section">
        <h3>{{ __('views.backend.section.navigation.sub_header_1') }}</h3>
        <ul class="nav side-menu">
          <li>
            <a href="{{ route('admin.users') }}">
              <i class="fa fa-users" aria-hidden="true"></i>
              {{ __('views.backend.section.navigation.menu_1_1') }}
            </a>
          </li>
        </ul>
      </div>
      <div class="menu_section">
        <h3>{{ __('views.backend.section.navigation.sub_header_shop') }}</h3>
        <ul class="nav side-menu">
          <li>
            <a href="{{ route('shop.index') }}">
              <i class="fa fa-users" aria-hidden="true"></i>
              {{ __('views.backend.section.navigation.menu_shop') }}
            </a>
          </li>
        </ul>
      </div>
      {{--
      <div class="menu_section">
      <h3>{{ __('views.backend.section.navigation.sub_header_3') }}</h3>
      <ul class="nav side-menu">
      <li>
      <a href="http://netlicensing.io/?utm_source=Laravel_Boilerplate&utm_medium=github&utm_campaign=laravel_boilerplate&utm_content=credits" target="_blank" title="Online Software License Management"><i class="fa fa-lock" aria-hidden="true"></i>NetLicensing</a>
    </li>
    <li>
    <a href="https://photolancer.zone/?utm_source=Laravel_Boilerplate&utm_medium=github&utm_campaign=laravel_boilerplate&utm_content=credits" target="_blank" title="Individual digital content for your next campaign"><i class="fa fa-camera-retro" aria-hidden="true"></i>Photolancer Zone</a>
  </li>
</ul>
</div>
--}}
</div>
<!-- /sidebar menu -->
</div>
</div>
