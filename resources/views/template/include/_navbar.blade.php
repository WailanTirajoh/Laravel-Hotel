<style>
    /* -----------------------------------------
   Timeline
----------------------------------------- */
    .timeline {
        list-style: none;
        padding-left: 0;
        position: relative;
    }

    .timeline:after {
        content: "";
        height: auto;
        width: 1px;
        background: #e3e3e3;
        position: absolute;
        top: 5px;
        left: 30px;
        bottom: 25px;
    }

    .timeline.timeline-sm:after {
        left: 12px;
    }

    .timeline li {
        position: relative;
        padding-left: 70px;
        margin-bottom: 20px;
    }

    .timeline li:after {
        content: "";
        width: 12px;
        height: 12px;
        border-radius: 50%;
        background: #e3e3e3;
        position: absolute;
        left: 24px;
        top: 5px;
    }

    .timeline li .timeline-date {
        display: inline-block;
        width: 100%;
        color: #a6a6a6;
        font-style: italic;
        font-size: 13px;
    }

    .timeline.timeline-icons li {
        padding-top: 7px;
    }

    .timeline.timeline-icons li:after {
        width: 32px;
        height: 32px;
        background: #fff;
        border: 1px solid #e3e3e3;
        left: 14px;
        top: 0;
        z-index: 11;
    }

    .timeline.timeline-icons li .timeline-icon {
        position: absolute;
        left: 23.5px;
        top: 7px;
        z-index: 12;
    }

    .timeline.timeline-icons li .timeline-icon [class*=glyphicon] {
        top: -1px !important;
    }

    .timeline.timeline-icons.timeline-sm li {
        padding-left: 40px;
        margin-bottom: 10px;
    }

    .timeline.timeline-icons.timeline-sm li:after {
        left: -5px;
    }

    .timeline.timeline-icons.timeline-sm li .timeline-icon {
        left: 4.5px;
    }

    .timeline.timeline-advanced li {
        padding-top: 0;
    }

    .timeline.timeline-advanced li:after {
        background: #fff;
        border: 1px solid #29b6d8;
    }

    .timeline.timeline-advanced li:before {
        content: "";
        width: 52px;
        height: 52px;
        border: 10px solid #fff;
        position: absolute;
        left: 4px;
        top: -10px;
        border-radius: 50%;
        z-index: 12;
    }

    .timeline.timeline-advanced li .timeline-icon {
        color: #29b6d8;
    }

    .timeline.timeline-advanced li .timeline-date {
        width: 75px;
        position: absolute;
        right: 5px;
        top: 3px;
        text-align: right;
    }

    .timeline.timeline-advanced li .timeline-title {
        font-size: 17px;
        margin-bottom: 0;
        padding-top: 5px;
        font-weight: bold;
    }

    .timeline.timeline-advanced li .timeline-subtitle {
        display: inline-block;
        width: 100%;
        color: #a6a6a6;
    }

    .timeline.timeline-advanced li .timeline-content {
        margin-top: 10px;
        margin-bottom: 10px;
        padding-right: 70px;
    }

    .timeline.timeline-advanced li .timeline-content p {
        margin-bottom: 3px;
    }

    .timeline.timeline-advanced li .timeline-content .divider-dashed {
        padding-top: 0px;
        margin-bottom: 7px;
        width: 200px;
    }

    .timeline.timeline-advanced li .timeline-user {
        display: inline-block;
        width: 100%;
        margin-bottom: 10px;
    }

    .timeline.timeline-advanced li .timeline-user:before,
    .timeline.timeline-advanced li .timeline-user:after {
        content: " ";
        display: table;
    }

    .timeline.timeline-advanced li .timeline-user:after {
        clear: both;
    }

    .timeline.timeline-advanced li .timeline-user .timeline-avatar {
        border-radius: 50%;
        width: 32px;
        height: 32px;
        float: left;
        margin-right: 10px;
    }

    .timeline.timeline-advanced li .timeline-user .timeline-user-name {
        font-weight: bold;
        margin-bottom: 0;
    }

    .timeline.timeline-advanced li .timeline-user .timeline-user-subtitle {
        color: #a6a6a6;
        margin-top: -4px;
        margin-bottom: 0;
    }

    .timeline.timeline-advanced li .timeline-link {
        margin-left: 5px;
        display: inline-block;
    }

    .timeline-load-more-btn {
        margin-left: 70px;
    }

    .timeline-load-more-btn i {
        margin-right: 5px;
    }


    /* -----------------------------------------
   Dropdown
----------------------------------------- */
    .dropdown-menu {
        padding: 0 0 0 0;
    }

    .dropdown-header {
        background: #f7f9fe;
        font-weight: bold;
        border-bottom: 1px solid #e3e3e3;
    }

    .dropdown-menu>li a {
        padding: 10px 20px;
    }

    .dropdown-toggle::after {
        content: none;
    }

    .bg-icon {
        background-color: #e4e6eb;
        border-radius: 50%
    }

    .unread {
        background-color: #e4e6eb;
        border-radius: 0.2rem
    }

</style>
<nav class="navbar navbar-expand navbar-light px-1 bg-white shadow-sm" style="height: 55px">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">
            <img src="{{ asset('img/logo/sip.png') }}" alt="" width="40" height="40"
                class="d-inline-block align-text-top">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <div class="dropdown ms-auto me-4" id="refreshThisDropdown">
                <div class="dropdown-toggle" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
                    <div class="btn position-relative bg-icon">
                        <i class="fas fa-bell">
                            @if (auth()->user()->unreadNotifications->count() > 0)
                                <span
                                    class="position-absolute mt-1 top-0 start-100 translate-middle badge rounded-pill bg-secondary">
                                    {{ auth()->user()->unreadNotifications->count() }}
                                    <span class="visually-hidden">unread messages</span></span>
                            @endif
                        </i>
                    </div>
                </div>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton2">
                    <div class="row">
                        <div class="col-lg-12">
                            <li role="presentation">
                                <div class="dropdown-header">Notifications</div>
                            </li>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <ul class="timeline timeline-icons timeline-sm" style="margin:10px;width:210px">
                                @forelse (auth()->user()->unreadNotifications as $notification)
                                    <li>
                                        <p>
                                            {{ $notification->data['message'] }} <a
                                                href="{{ $notification->data['url'] }}">here</a>
                                            <span class="timeline-icon"><i class="fa fa-file-pdf-o"
                                                    style="color:red"></i></span>
                                            <span class="timeline-date">{{ $notification->created_at }}</span>
                                        </p>
                                    </li>
                                @empty
                                    <p class="text-center">
                                        There's no new notification
                                    </p>
                                @endforelse
                            </ul>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-lg-12">
                            <li role="presentation">
                                <div class="row">
                                    <div class="col-lg-12 text-center">
                                        <a href="{{ route('notification.markAllAsRead') }}"
                                            class="float-start mb-2 ms-2">Mark all as read</a>
                                        <a href="" class="float-end mb-2 me-2">See All</a>
                                    </div>
                                </div>
                            </li>
                        </div>
                    </div>
                </ul>

            </div>
            <div class="dropdown">
                <div class="dropdown-toggle" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="{{ auth()->user()->getAvatar() }}" class="rounded-circle img-thumbnail"
                        style="cursor: pointer" width="40" height="40" alt="">
                </div>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton1">
                    <li><a class="dropdown-item"
                            href="{{ route('user.show', ['user' => auth()->user()->id]) }}">Profil</a>
                    </li>
                    <li><a class="dropdown-item" href="#">Activity</a></li>
                    <li><a class="dropdown-item" href="#">Setting</a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <form action="/logout" method="POST">
                        @csrf
                        <li><button class="dropdown-item" type="submit">Logout</button></li>
                    </form>
                </ul>
            </div>
        </div>
    </div>
</nav>
