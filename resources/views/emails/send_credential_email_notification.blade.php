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
                width: 500px;
                margin-top: 20px !important;
                margin: auto;
                padding: 15px !important;
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

            .address-table .key-column {
                width: 25%; /* Set the width of the key column */
            }

            .address-table .value-column {
                width: 75%; /* Set the width of the value column */
                word-wrap: break-word;
                overflow-wrap: break-word;
            }

            .body-text-color {
                color: #2A3342;
                text-decoration: none;
                font-weight: 600;
                font-family: Poppins, sans-serif;
            }

            .body-text-color a {
                color: #2A3342;
                text-decoration: none;
                font-weight: 600;
                font-family: Poppins, sans-serif;
            }

            .email-text-color {
                color: #E8604C !important; /* Force the color to override other styles */
                font-weight: 600;
                font-family: Poppins, sans-serif;
            }

            .email-text-color a {
                color: #E8604C !important; /* Force the color to override other styles */
                font-weight: 600;
                font-family: Poppins, sans-serif;
                word-wrap: break-word;
                overflow-wrap: break-word;
            }


            @media (max-width: 500px) {
                .body-address-box {
                    width: auto;
                }
                .address-table .value-column {
                    padding-left: 8px !important;
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
        width: 100%; /* Ensures full width */
      "
    >
        <tbody>
        <tr>
            <!-- Image Cell -->
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
                    Access to
                </span>
                <a
                    href="https://www.TheVacationCalendar.com"
                    style="
                        margin: 0;
                        text-decoration: none;
                        font-family: Poppins, sans-serif;
                        font-size: 22px;
                        font-style: normal;
                        color: #ffffff;
                      "
                >
                    TheVacationCalendar.com
                </a>
            </td>
        </tr>
        </tbody>
    </table>

    <p class="body-text">Dear {{ $createUser->first_name .' '. $createUser->last_name }},</p>

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
                <a
                    href="https://TheVacationCalendar.com"
                    style="
                                margin: 0;
                                text-decoration: none;
                                font-family: Poppins, sans-serif;
                                font-size: 16px;
                                font-style: normal;
                                line-height: 14px;
                                font-weight: 600;
                                color: #E8604C;
                              "
                >
                    TheVacationCalendar.com!
                </a>
                <span
                    style="
                                margin: 0;
                                text-decoration: none;
                                font-family: Poppins, sans-serif;
                                font-size: 16px;
                                font-style: normal;
                                color: #2A3342;
                              ">
                    Below is your username and password as a(n)
                    @if($createUser->role === 'Owner')
                        Scheduler
                    @else
                        {{ $createUser->role }}
                    @endif
                    at the vacation home, <strong>{{$houseName}}</strong>.
                    We look forward to you helping us manage our home effectively.

                    </span>
            </td>
        </tr>
        </tbody>
    </table>


    <!-- House Info Section -->
    <div class="body-address-box">
        <table class="address-table" cellpadding="0" cellspacing="0">
            <tbody>
            <tr>
                <td class="key-column">House Name:</td>
                <td class="value-column"><span class="body-text-color">{{$houseName}}</span></td>
            </tr>
            <tr>
                <td class="key-column">Role:</td>
                <td class="value-column">
                <span class="body-text-color">
                    @if($createUser->role === 'Owner')
                        Scheduler
                    @else
                        {{ $createUser->role }}
                    @endif
                </span>
                </td>
            </tr>
            <tr>
                <td class="key-column">Email:</td>
                <td class="value-column"><span class="email-text-color">{{$createUser->email}}</span></td>
            </tr>
            <tr>
                <td class="key-column">Username:</td>
                <td class="value-column"><span class="body-text-color">{{$createUser->user_name}}</span></td>
            </tr>
            <tr>
                <td class="key-column">Password:</td>
                <td class="value-column"><span class="body-text-color">{{$sendPasswordToMail}}</span></td>
            </tr>
            </tbody>
        </table>
    </div>
    <!-- House Info Section -->


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
                     To get started, log in to your account by visiting
                    </span>
                <a
                    href="https://TheVacationCalendar.com"
                    style="
                                margin: 0;
                                text-decoration: none;
                                font-family: Poppins, sans-serif;
                                font-size: 16px;
                                font-style: normal;
                                line-height: 14px;
                                font-weight: 600;
                                color: #E8604C;
                              "
                >
                    TheVacationCalendar.com.
                </a>
                <span
                    style="
                                margin: 0;
                                text-decoration: none;
                                font-family: Poppins, sans-serif;
                                font-size: 16px;
                                font-style: normal;
                                color: #2A3342;
                              ">
                     Click <strong>Login</strong> at the top right of the page, then search for your house using the <strong>{{$houseName}}</strong>.
                    Once your house appears, select it and click the <strong>Administrator & Scheduler</strong>
        button to access the appropriate login page. Enter your email address (or username) and password (provided
        below) to access the home.
                </span>
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
                     Alternatively, you can go directly to your house using
                    </span>
                <a
                    href="{{$siteUrl}}"
                    style="
                                margin: 0;
                                text-decoration: none;
                                font-family: Poppins, sans-serif;
                                font-size: 16px;
                                font-style: normal;
                                line-height: 14px;
                                font-weight: 600;
                                color: #E8604C;
                              "
                >
                    this link.
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
                    <strong>Pro Tip:</strong> Bookmark
                    </span>
                <a
                    href="{{$siteUrl}}"
                    style="
                                margin: 0;
                                text-decoration: none;
                                font-family: Poppins, sans-serif;
                                font-size: 16px;
                                font-style: normal;
                                line-height: 14px;
                                color: #E8604C;
                                font-weight: 600;
                              "
                >
                    this link
                </a>
                <span
                    style="
                                margin: 0;
                                text-decoration: none;
                                font-family: Poppins, sans-serif;
                                font-size: 16px;
                                font-style: normal;
                                color: #2A3342;
                              ">
                    above to your favorites and you can jump to the correct login page with one click from your browser's favorites.
                    </span>
            </td>
        </tr>
        </tbody>
    </table>


    <!-- Help Section -->
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
                    As a(n)
                        @if($createUser->role === 'Owner')
                            Scheduler
                        @else
                            {{ $createUser->role }}
                        @endif
                        you can schedule vacations, add to the local guide of restaurants and things to do,
                        share pictures and so much more! If you have questions, please check out our
                    </span>
                <a
                    href="https://youtube.com/playlist?list=PLxQfh1gnJa77a5kzRzEXjhOGmsbLfHGO3&si=JLIS4if_lM6palpM"
                    style="
                                margin: 0;
                                text-decoration: none;
                                font-family: Poppins, sans-serif;
                                font-size: 16px;
                                font-style: normal;
                                line-height: 14px;
                                color: #E8604C;
                                font-weight: 600;
                              "
                >
                    YouTube channel of training videos,
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
                <a
                    href="https://www.TheVacationCalendar.com"
                    style="
                                margin: 0;
                                text-decoration: none;
                                font-family: Poppins, sans-serif;
                                font-size: 16px;
                                font-style: normal;
                                color: #2A3342;
                              "
                >
                    TheVacationCalendar.com,
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
