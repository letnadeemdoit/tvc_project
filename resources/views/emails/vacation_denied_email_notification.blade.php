<x-email-layout>
    @push('stylesheets')
        <style>
            .template-header-bg {
                background-color: #E8604C;
            }
            .header-heading h2{
                padding: 15px 25px;
                font-size: 22px;
                color: #ffffff;
            }
            p {
                line-height: 22px;
            }

            .body-text {
                font-size: 16px;
                line-height: 25px;
            }

            .template-border-color {
                border-color: #E8604C !important;
            }

            .body-address-box {
                border: 1px solid #E8604C;
                border-radius: 10px;
                width: 330px;
                margin: 20px auto 20px auto;
            }
            .body-address-box ul {
                padding: 12px 14px;
                margin: 0;
            }
            .body-address-box ul li {
                list-style: none;
                color: #6D6D6D;
            }

            .body-address-box ul li:not(:last-child) {
                margin-bottom: 10px;
            }

            .body-text-color {
                color: #2A3342;
            }

            .template-body-link-color {
                color: #E8604C;
                font-weight: 600;
            }
            .font-weight-bold {
                font-weight: 700;
            }

            @media (max-width: 500px) {
                .body-address-box {
                    width: auto;
                }
            }
        </style>
    @endpush

    <div class="header-heading">
        <h2 class="template-header-bg">{{$vacName}} at {{$houseName}} was Denied</h2>
    </div>

    <p class="body-text">
        {{$name}}
    </p>

    <p class="body-text">
        Your vacation request has been denied at {{$houseName}}.
    </p>

    <!-- House Info Section -->
    <div class="body-address-box">
        <ul>
            <li>Vacation Name: <span class="body-text-color">{{$vacName}}</span></li>
            <li>Vacation Dates: <span class="body-text-color">{{$startDate . ' to ' . $endDate}}</span></li>
            <li>Denied By: <span class="body-text-color">{{$admin->first_name . ' ' . $admin->last_name}} ({{$admin->email}})</span></li>
            {{--            <li>Email Address: <a href="mailto:simon.storm@gmail.com" class="template-body-link-color fw-bold">{{$user->email}}</a></li>--}}
            {{--            <li>Username: <span class="body-text-color">{{ $user->first_name. ' ' . $user->last_name }}</span></li>--}}
        </ul>
    </div>
    <!-- Help Section -->
    <p class="body-text">Thank you for using TheVacationCalendar.com!</p>
    <!-- Signature Section -->
    <p class="body-text"><a href="#" class="template-body-link-color fw-medium">TheVacationCalendar.com Team</a></p>
    <!-- Rest of your content -->
</x-email-layout>
