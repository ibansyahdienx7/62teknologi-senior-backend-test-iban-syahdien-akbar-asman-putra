@extends('mails.layout')

@section('content_email')
    <div style="margin-top: 30px !important;margin-bottom: 20px">

        @if ($data['title_mail'] == 'subscribe')
            <div
                style="margin-top: 20px; padding: 20px 20px; border-bottom: 2px solid #fff;background: #F2F2F2; color: #5B5B5B">

                <h4 style="text-align:center; font-size: 18px; color: #000">
                    {{ $data['title'] }}
                </h4>

                @if ($data['role'] == 'user')
                    <p style="text-align:left; color: #000; font-size:16px">
                        Hello {{ $data['email'] }},
                    </p>
                    <p style="text-align:left; color: #000; font-size:16px">
                        Thank you for subscribing to the newsletter Wids Roti Bakar Bandung!, We will provide the latest interesting news for you
                    </p>
                @else
                    <p style="text-align:left; color: #000; font-size:16px">
                        Hello {{ config('app.brand') }},
                    </p>
                    <p style="text-align:left; color: #000; font-size:16px">
                        {{ $data['email_user'] }} telah berlangganan buletin pada tanggal {{ date_format(date_create(now()), 'd F, Y H:i A') }}
                    </p>
                @endif

                <p style="color: #000 !important; text-align:left; font-size:16px">

                    <center>
                        <h3 style="font-weight: bold; font-size: 20px;">
                            Order Here
                        </h3>
                        <br/>
                        <div>
                            <a href="{{ config('app.link_grabfood') }}" target="_blank" class="btn-grabfood">
                                Grab Food
                            </a>
                            &nbsp;&nbsp;
                            <a href="{{ config('app.link_gofood') }}" target="_blank" class="btn-gofood">
                                Go Food
                            </a>
                        </div>
                    </center>

                </p>
                <br />

                <div style='margin-top: 10px'>
                    <p style='text-align:center; color: #000 !important'>
                        This message is an automated message from {{ config('app.brand') }}
                    </p>
                </div>
            </div>

        @elseif($data['title_mail'] == 'contact')

            <div
                style="margin-top: 20px; padding: 20px 20px; border-bottom: 2px solid #fff;background: #F2F2F2; color: #5B5B5B">

                <h4 style="text-align:center; font-size: 18px; color: #000">
                    {{ $data['title'] }}
                </h4>

                @if ($data['role'] == 'user')
                    <p style="text-align:left; color: #000; font-size:16px">
                        Hello {{ $data['name'] }},
                    </p>
                    <p style="text-align:left; color: #000; font-size:16px">
                        Thank you for contacting us, we will reply to your message as soon as possible via email. Please see your email for a reply from
                        {{ config('app.brand') }}
                    </p>

                    <center>
                        <a href="{{ config('app.link_wa') }}" class="btn-custom" target="_blank">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M18.403 5.633A8.919 8.919 0 0 0 12.053 3c-4.948 0-8.976 4.027-8.978 8.977 0 1.582.413 3.126 1.198 4.488L3 21.116l4.759-1.249a8.981 8.981 0 0 0 4.29 1.093h.004c4.947 0 8.975-4.027 8.977-8.977a8.926 8.926 0 0 0-2.627-6.35m-6.35 13.812h-.003a7.446 7.446 0 0 1-3.798-1.041l-.272-.162-2.824.741.753-2.753-.177-.282a7.448 7.448 0 0 1-1.141-3.971c.002-4.114 3.349-7.461 7.465-7.461a7.413 7.413 0 0 1 5.275 2.188 7.42 7.42 0 0 1 2.183 5.279c-.002 4.114-3.349 7.462-7.461 7.462m4.093-5.589c-.225-.113-1.327-.655-1.533-.73-.205-.075-.354-.112-.504.112s-.58.729-.711.879-.262.168-.486.056-.947-.349-1.804-1.113c-.667-.595-1.117-1.329-1.248-1.554s-.014-.346.099-.458c.101-.1.224-.262.336-.393.112-.131.149-.224.224-.374s.038-.281-.019-.393c-.056-.113-.505-1.217-.692-1.666-.181-.435-.366-.377-.504-.383a9.65 9.65 0 0 0-.429-.008.826.826 0 0 0-.599.28c-.206.225-.785.767-.785 1.871s.804 2.171.916 2.321c.112.15 1.582 2.415 3.832 3.387.536.231.954.369 1.279.473.537.171 1.026.146 1.413.089.431-.064 1.327-.542 1.514-1.066.187-.524.187-.973.131-1.067-.056-.094-.207-.151-.43-.263">
                                </path>
                            </svg>
                            &nbsp;
                            Chat Whatsapp
                        </a>
                    </center>
                @else
                    <p style="text-align:left; color: #000; font-size:16px">
                        Hello {{ config('app.brand') }},
                    </p>
                    <p style="text-align:left; color: #000; font-size:16px">
                        {{ $data['name'] }} telah mengirim pesan pada tanggal {{ date_format(date_create(now()), 'd F, Y H:i A') }}.
                        Mohon untuk membalas pesan dari {{ $data['name'] }} secepatnya. Terima Kasih.

                        <p style="text-align:left; color: #000; font-size:16px">
                            Detail :
                            <ul>
                                <li>
                                    Nama : {{ $data['name'] }}
                                </li>
                                <li>
                                    Email : {{ $data['email_user'] }}
                                </li>
                                <li>
                                    Subject : {{ $data['subjects'] }}
                                </li>
                                <li>
                                    Pesan : {{ $data['pesan'] }}
                                </li>
                            </ul>
                        </p>

                        <center>
                            <a href="mailto:{{ $data['email_user'] }}?subject=Reply Message {{ $data['name'] }} From Web {{ config('app.brand') }}" class="btn-custom" target="_blank">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M18.403 5.633A8.919 8.919 0 0 0 12.053 3c-4.948 0-8.976 4.027-8.978 8.977 0 1.582.413 3.126 1.198 4.488L3 21.116l4.759-1.249a8.981 8.981 0 0 0 4.29 1.093h.004c4.947 0 8.975-4.027 8.977-8.977a8.926 8.926 0 0 0-2.627-6.35m-6.35 13.812h-.003a7.446 7.446 0 0 1-3.798-1.041l-.272-.162-2.824.741.753-2.753-.177-.282a7.448 7.448 0 0 1-1.141-3.971c.002-4.114 3.349-7.461 7.465-7.461a7.413 7.413 0 0 1 5.275 2.188 7.42 7.42 0 0 1 2.183 5.279c-.002 4.114-3.349 7.462-7.461 7.462m4.093-5.589c-.225-.113-1.327-.655-1.533-.73-.205-.075-.354-.112-.504.112s-.58.729-.711.879-.262.168-.486.056-.947-.349-1.804-1.113c-.667-.595-1.117-1.329-1.248-1.554s-.014-.346.099-.458c.101-.1.224-.262.336-.393.112-.131.149-.224.224-.374s.038-.281-.019-.393c-.056-.113-.505-1.217-.692-1.666-.181-.435-.366-.377-.504-.383a9.65 9.65 0 0 0-.429-.008.826.826 0 0 0-.599.28c-.206.225-.785.767-.785 1.871s.804 2.171.916 2.321c.112.15 1.582 2.415 3.832 3.387.536.231.954.369 1.279.473.537.171 1.026.146 1.413.089.431-.064 1.327-.542 1.514-1.066.187-.524.187-.973.131-1.067-.056-.094-.207-.151-.43-.263">
                                    </path>
                                </svg>
                                &nbsp;
                                Balas
                            </a>
                        </center>
                    </p>
                @endif

                <p style="color: #000 !important; text-align:left; font-size:16px; margin-top: 15%">

                    <center>
                        <h3 style="font-weight: bold; font-size: 20px;">
                            Order Here
                        </h3>
                        <br/>
                        <div>
                            <a href="{{ config('app.link_grabfood') }}" target="_blank" class="btn-grabfood">
                                Grab Food
                            </a>
                            &nbsp;&nbsp;
                            <a href="{{ config('app.link_gofood') }}" target="_blank" class="btn-gofood">
                                Go Food
                            </a>
                        </div>
                    </center>

                </p>
                <br />

                <div style='margin-top: 10px'>
                    <p style='text-align:center; color: #000 !important'>
                        This message is an automated message from {{ config('app.brand') }}
                    </p>
                </div>
            </div>

        @endif

        <br />
    </div>
@endsection

@section('footer')
    <p style='text-align:center'>
        Best Regards, <br/> <b>{{ config('app.brand') }}</b>
    </p>
@endsection
