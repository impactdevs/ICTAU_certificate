<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Membership Confirmation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 50px auto;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
        }

        .header {
            background-color: #4CAF50;
            color: #fff;
            padding: 20px;
            text-align: center;
            border-top-left-radius: 8px;
            border-top-right-radius: 8px;
        }

        .header h1 {
            margin: 0;
        }

        .content {
            padding: 30px;
            line-height: 1.6;
            background-color: #f9f9f9;
        }

        .signature {
            margin-top: 30px;
            text-align: right;
        }

        .signature strong {
            display: block;
            margin-bottom: 5px;
        }

        .footer {
            background-color: #f1f1f1;
            padding: 20px;
            text-align: center;
            font-size: 0.9rem;
            color: #333;
            border-bottom-left-radius: 8px;
            border-bottom-right-radius: 8px;
        }

        .footer .payment-details p {
            margin: 5px 0;
        }

        .footer .payment-details strong {
            color: #4CAF50;
        }

        .footer .payment-details a {
            color: #007bff;
            text-decoration: none;
        }

        .footer .payment-details a:hover {
            text-decoration: underline;
        }

    </style>
</head>

<body>

    <div class="container">
        <div class="header">
            <h1>Welcome to ICTAU</h1>
        </div>
        <div class="content">
            <!-- Student or Professional Membership Confirmation -->
            @if ($applicant->application_type == 'student' || $applicant->application_type == 'professional')
                <p>Congratulations on becoming a {{ $applicant->application_type }} Member of the ICT Association of
                    Uganda (ICTAU) for 2024. Your membership enriches our community with your unique skills and
                    dedication to the ICT sector.</p>

                <p>As a member, you join a network committed to promoting innovation and excellence in Uganda's ICT
                    ecosystem. You have access to networking events, professional development opportunities, and a
                    platform to share insights and collaborate on initiatives that drive our sector forward.</p>

                <p>We count on you to uphold the highest standards of professionalism and ethical conduct, contributing
                    positively to our collective mission of advancing the ICT landscape in Uganda.</p>

                <p>We look forward to your contributions and the impact we will create together.</p>
            @endif

            <!-- Company Membership Confirmation -->
            @if ($applicant->application_type == 'company')
                <p>Welcome to the ICT Association of Uganda (ICTAU). We are honored to have
                    {{ $applicant->company_name }} as a Corporate Member for the year 2024. Your support plays a pivotal
                    role in our mission to foster a robust and innovative ICT sector in Uganda.</p>

                <p>Corporate membership with ICTAU not only signifies your company's commitment to technological
                    advancement but also positions you as a key player in shaping the future of the ICT ecosystem. You
                    now have unparalleled access to a network of professionals, opportunities for industry
                    collaboration, and platforms for showcasing your leadership in tech-driven initiatives.</p>

                <p>As part of our community, we encourage {{ $applicant->company_name }} to actively engage in ICTAU
                    activities, share expertise, and collaborate on projects that drive sector growth.</p>

                <p>We also emphasize the importance of ethical conduct and social responsibility in all endeavors. As a
                    corporate member, you lead by example, setting standards for integrity, innovation, and impact in
                    the ICT domain.</p>

                <p>Once again, welcome to ICTAU. Your insights and contributions are invaluable to our collective
                    success.</p>
            @endif

            <div class="signature">
                <strong>Nkurunungi Gideon</strong>
                Chief Executive Officer<br>
                ICT Association of Uganda
            </div>
        </div>
    </div>

    <!-- Footer Section -->
    <div class="footer">
        <div class="payment-details">
            <p><strong>Payment Details</strong></p>
            <p><strong>Bank:</strong> Housing Finance Bank</p>
            <p><strong>Account Number:</strong> 1040006744842</p>
            <p><strong>Account Name:</strong> ICT Association of Uganda</p>
            <p><strong>Students:</strong> UGX 5,000</p>
            <p><strong>Professionals:</strong> UGX 200,000</p>
            <p><strong>Companies & MDAs:</strong> UGX 2,000,000</p>
            <p>For payment, please use the details above or <a href="mailto:info@ictau.org" target="_blank">contact us</a> for assistance.</p>
        </div>
    </div>

</body>

</html>
