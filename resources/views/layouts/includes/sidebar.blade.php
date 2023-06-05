<div class="vertical-menu">
    <div data-simplebar class="h-100">
        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title" key="t-menu">Menu</li>
                <li>
                    <a href="{{ route('admin.home') }}" class="waves-effect">
                        <i class="bx bx-home-circle"></i>
                        <span key="t-chat">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.home_page_content.edit') }}" class="waves-effect">
                        <i class="bx bx-building-house"></i>
                        <span key="t-chat">Home Page Content</span>
                    </a>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow" key="t-vertical"><i class="bx bx-notepad"></i>
                        <span key="t-chat">Schedule</span></a>
                    <ul class="sub-menu" aria-expanded="true">
                        <li><a href="{{ route('admin.schedule.index') }}" key="t-compact-sidebar">List</a></li>
                        <li><a href="{{ route('admin.schedule.add') }}" key="t-light-sidebar">Add</a></li>
                        <li><a href="{{ route('admin.schedule.register_index') }}" key="t-light-sidebar">Register List</a></li>
                    </ul>
                </li>
                <li>
                    <a href="{{ route('admin.gallery.list') }}" class="waves-effect">
                        <i class="bx bx-image-alt"></i>
                        <span key="t-chat">Gallery</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.home_page_slider.list') }}" class="waves-effect">
                        <i class="bx bx-image-alt"></i>
                        <span key="t-chat">Home Page Slider</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.aboutus_page_content.edit') }}" class="waves-effect">
                        <i class="bx bx-book-open"></i>
                        <span key="t-chat">About Us</span>
                    </a>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow" key="t-vertical"><i class="bx bx-notepad"></i>
                        <span key="t-chat">FAQ</span></a>
                    <ul class="sub-menu" aria-expanded="true">
                        <li><a href="{{ route('admin.faq_content.index') }}" key="t-compact-sidebar">List</a></li>
                        <li><a href="{{ route('admin.faq_content.add') }}" key="t-light-sidebar">Add</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow" key="t-vertical"><i class="bx bxs-contact"></i>
                        <span key="t-chat">Contact US</span></a>
                    <ul class="sub-menu" aria-expanded="true">
                        <li><a href="{{ route('admin.contactus_page_content.edit') }}" key="t-compact-sidebar">Contact Us</a></li>
                        <li><a href="{{ route('admin.contactus_page_content.register_index') }}" key="t-light-sidebar">Contact Us Form</a></li>
                    </ul>
                </li>
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
