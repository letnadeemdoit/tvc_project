<x-email-layout>
    @push('stylesheets')
        <style>
            .body-text {
                font-size: 16px;
                line-height: 25px;
                color: #2A3342;
                font-family: Poppins, sans-serif;
            }

            .body-address-box {
                border: 1px solid #E8604C;
                border-radius: 10px;
                width: 400px;
                margin: 20px auto;
                padding: 12px 14px;
            }

            .address-table {
                width: 100%; /* Make the table fill the container */
                border-collapse: collapse; /* Remove extra spacing between cells */
                font-family: Poppins, sans-serif;
            }

            .address-table td {
                padding: 6px 0; /* Add spacing between rows */
                color: #6D6D6D;
                font-family: Poppins, sans-serif;
                font-size: 16px;
                line-height: 25px;
            }

            .body-text-color {
                color: #2A3342;
                text-decoration: none;
                font-weight: 600;
                font-family: Poppins, sans-serif;
            }
            .email-text-color {
                color: #2A3342 !important; /* Force the color to override other styles */
                font-weight: 600;
                font-family: Poppins, sans-serif;
            }
            .email-text-color a{
                color: #2A3342 !important; /* Force the color to override other styles */
                font-weight: 600;
                font-family: Poppins, sans-serif;
            }

            @media (max-width: 500px) {
                .body-address-box {
                    width: auto;
                }
            }

        </style>
    @endpush

    <table
        border="0"
        cellpadding="0"
        cellspacing="0"
        style="
        font-size: 22px;
        color: #ffffff;
        font-family: Poppins, sans-serif;
        line-height: 1.2;
        margin: 0;
        padding: 0;
        border-spacing: 0;
        border-collapse: collapse;
        background-color: #E8604C;
        width: 100%;
      "
    >
        <tbody>
        <tr>
            <td style="padding: 20px;">
                    <span
                        style="
                        margin: 0;
                        text-decoration: none;
                        font-family: Poppins, sans-serif;
                        font-size: 22px;
                        font-style: normal;
                        color: #ffffff;
                      "
                    >
                    Vacation removed from {{$createdHouseName}} calendar.
                </span>
            </td>
        </tr>
        </tbody>
    </table>

    <p class="body-text">
        The following vacation has been removed from the {{$createdHouseName}} calendar.
    </p>
    <!-- House Info Section -->
    <div class="body-address-box">
        <table class="address-table" cellpadding="0" cellspacing="0">
            <tbody>
            <tr>
                <td>Vacation Name:<span class="body-text-color">{{$name}}</span></td>
            </tr>
            <tr>
                <td>Vacation Dates:<span class="body-text-color">{{$startDate . ' to ' . $endDate}}</span></td>
            </tr>
            <tr>
                <td>
                    Created By:
                    <span class="body-text-color">
                    {{ $vacOwner->first_name. ' ' . $vacOwner->last_name }}
                        </span>
                    (<span class="email-text-color">{{$vacOwner->email}}</span>)
                </td>
            </tr>
            <tr>
                <td>
                    Created By:
                    <span class="body-text-color">
                    {{ $user->first_name. ' ' . $user->last_name }}
                        </span>
                    (<span class="email-text-color">{{$user->email}}</span>)
                </td>
            </tr>
            </tbody>
        </table>
    </div>

    <!-- Thank You Section -->

    <table
        border="0"
        cellpadding="0"
        cellspacing="0"
        style="
                        font-family: Poppins, sans-serif;
                        line-height: 1.2;
                        font-size: 16px;
                        padding: 0;
                        margin: 0;
                        margin-top: 10px;
                        border-spacing: 0;
                        border-collapse: collapse;
                      "
    >
        <tbody>
        <tr>
            <!-- Image Cell -->
            <td
                style="vertical-align: middle"
            >
                    <span
                        style="
                                margin: 0;
                                text-decoration: none;
                                font-family: Poppins, sans-serif;
                                font-size: 16px;
                                font-style: normal;
                                color: #2A3342;
                              ">
                    Thank you for using
                    </span>
            </td>
            <!-- Text Cell -->
            <td style="padding-left: 4px;  vertical-align: middle">
                <a
                    href="https://www.TheVacationCalendar.com"
                    style="
                                margin: 0;
                                text-decoration: none;
                                font-family: Poppins, sans-serif;
                                font-size: 16px;
                                font-style: normal;
                                line-height: 14px;
                                color: #2A3342;
                              "
                >
                    TheVacationCalendar.com
                </a>
            </td>
        </tr>
        </tbody>
    </table>

    <table
        border="0"
        cellpadding="0"
        cellspacing="0"
        style="
                        font-family: Poppins, sans-serif;
                        line-height: 1.2;
                        font-size: 16px;
                        padding: 0;
                        margin: 0;
                        margin-top: 10px;
                        border-spacing: 0;
                        border-collapse: collapse;
                      "
    >
        <tbody>
        <tr>
            <!-- Image Cell -->
            <td style="padding: 0; vertical-align: middle">
                <a
                    href="https://www.TheVacationCalendar.com"
                    style="
                                margin: 0;
                                text-decoration: none;
                                font-family: Poppins, sans-serif;
                                font-size: 16px;
                                font-style: normal;
                                font-weight: 600;
                                color: #E8604C;
                              "
                >
                    TheVacationCalendar.com
                </a>
            </td>
            <td
                style="padding-left: 4px; vertical-align: middle"
            >
                    <span
                        style="
                                margin: 0;
                                text-decoration: none;
                                font-family: Poppins, sans-serif;
                                font-size: 16px;
                                font-style: normal;
                                color: #2A3342;
                              "
                    >
                    Team
                    </span>
            </td>

        </tr>
        </tbody>
    </table>

</x-email-layout>
