<x-email-layout>
    @push('stylesheets')
        <style>
            .body-text {
                font-size: 16px;
                line-height: 25px;
                color: #2A3342;
                font-family: Poppins, sans-serif;
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
                    Local Guide was deleted from {{$createdHouseName}}
                </span>
            </td>
        </tr>
        </tbody>
    </table>

    <p class="body-text">
        {{$title}} Local Guide has been deleted from {{$createdHouseName}} by {{$user->first_name . ' ' . $user->last_name}}.
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
