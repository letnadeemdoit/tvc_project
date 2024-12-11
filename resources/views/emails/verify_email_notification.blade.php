<x-email-layout>
    @push('stylesheets')
        <style>
            .body-text {
                font-size: 16px;
                line-height: 25px;
                color: #2A3342;
                font-family: Poppins, sans-serif;
            }

            .link-text-center {
                text-align: center;
            }

            .body-address-box ul {
                padding: 12px 14px;
                margin: 0;
            }

            .body-address-box ul li {
                list-style: none;
                color: #6D6D6D;
                font-family: Poppins, sans-serif;
            }

            .body-address-box ul li:not(:last-child) {
                margin-bottom: 10px;
            }

            .anchor-text-color a {
                color: #2A3342;
                text-decoration: none;
                font-family: Poppins, sans-serif;
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
                    Verify Email Address
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


    <p class="body-text">
        Please click the button below to verify your email address.
    </p>

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
        width: 100%;
      "
    >
        <tbody>
        <tr>
            <!-- Image Cell -->
            <td style="padding: 0; vertical-align: middle; text-align: center;">
                <a
                    href="{{$url}}"
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
                    Verify Email Address
                </a>
            </td>
        </tr>
        </tbody>
    </table>


    <p class="body-text">
        If you did not create an account, no further action is required.
    </p>

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
