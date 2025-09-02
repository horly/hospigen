<aside class="page-sidebar">
    <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
    <div class="main-sidebar" id="main-sidebar">
        <ul class="sidebar-menu" id="simple-bar">
            <li class="pin-title sidebar-main-title">
            <div>
                <h5 class="sidebar-title f-w-700">{{ __('dashboard.pinned') }}</h5>
            </div>
            </li>
            <li class="sidebar-main-title">
                <div>
                    <h5 class="lan-1 f-w-700 sidebar-title">{{ __('dashboard.general') }}</h5>
                </div>
            </li>
            <li class="sidebar-list">
                <i class="fa-solid fa-thumbtack"></i>
                <a class="sidebar-link @if(Request::route()->getName() == "app_dashboard") active @endif" href="{{ route('app_dashboard', ['id_site' => $site->id, 'id_room' => $room->id]) }}">
                    <i class="iconly-Home icli stroke-icon"></i>
                    <h6 class="f-w-600">{{ __('dashboard.dashboard') }} </h6>
                </a>
            </li>
            <li class="sidebar-list">
                <i class="fa-solid fa-thumbtack"></i>
                <a class="sidebar-link @if(Request::route()->getName() == "app_armoire" || Request::route()->getName() == "app_add_armoire") active @endif" href="{{ route('app_armoire', ['id_site' => $site->id, 'id_room' => $room->id]) }}">
                    <i class="iconly-Bookmark icli stroke-icon"></i>
                    <h6 class="f-w-600">{{ __('dashboard.cabinets') }} </h6>
                </a>
            </li>
            <li class="sidebar-list">
                <i class="fa-solid fa-thumbtack"></i>
                <a class="sidebar-link @if(Request::route()->getName() == "app_etagere" || Request::route()->getName() == "app_add_etagere") active @endif" href="{{ route('app_etagere', ['id_site' => $site->id, 'id_room' => $room->id]) }}">
                    <i class="iconly-Filter icli stroke-icon"></i>
                    <h6 class="f-w-600">{{ __('dashboard.shelves') }} </h6>
                </a>
            </li>
            <li class="sidebar-list">
                <i class="fa-solid fa-thumbtack"></i>
                <a class="sidebar-link @if(Request::route()->getName() == "app_boite" || Request::route()->getName() == "app_add_boite") active @endif" href="{{ route('app_boite', ['id_site' => $site->id, 'id_room' => $room->id]) }}">
                    <i class="iconly-Bag-2 icli stroke-icon"></i>
                    <h6 class="f-w-600">{{ __('dashboard.boxes') }} </h6>
                </a>
            </li>
            <li class="sidebar-list">
                <i class="fa-solid fa-thumbtack"></i>
                <a class="sidebar-link @if(Request::route()->getName() == "app_classeur" || Request::route()->getName() == "app_add_classeur") active @endif" href="{{ route('app_classeur', ['id_site' => $site->id, 'id_room' => $room->id]) }}">
                    <i class="iconly-Category icli stroke-icon"></i>
                    <h6 class="f-w-600">{{ __('dashboard.binders') }} </h6>
                </a>
            </li>
            <li class="sidebar-list">
                <i class="fa-solid fa-thumbtack"></i>
                <a class="sidebar-link @if(Request::route()->getName() == "app_chemise" || Request::route()->getName() == "app_add_chemise") active @endif" href="{{ route('app_chemise', ['id_site' => $site->id, 'id_room' => $room->id]) }}">
                    <i class="iconly-Folder icli stroke-icon"></i>
                    <h6 class="f-w-600">{{ __('dashboard.folders') }} </h6>
                </a>
            </li>
             <li class="sidebar-list">
                <i class="fa-solid fa-thumbtack"></i>
                <a class="sidebar-link @if(Request::route()->getName() == "app_document" || Request::route()->getName() == "app_add_document") active @endif" href="{{ route('app_document', ['id_site' => $site->id, 'id_room' => $room->id]) }}">
                    <i class="iconly-Document icli stroke-icon"></i>
                    <h6 class="f-w-600">Documents </h6>
                </a>
            </li>
        </ul>
    </div>
    <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
</aside>
