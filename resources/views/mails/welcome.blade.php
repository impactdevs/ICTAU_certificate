<div>
    @if ($applicant->application_type == 'student' || $applicant->application_type == 'professional')
        <pre>
        Congratulations on becoming a {{ $applicant->application_type }} Member of the ICT
        Association of Uganda (ICTAU) for 2024. Your membership enriches our community with your
        unique skills and dedication to the ICT sector.

        As a member, you join a network committed to promoting innovation and excellence in
        Uganda's ICT ecosystem. You have access to networking events, professional development
        opportunities, and a platform to share insights and collaborate on initiatives that drive our
        sector forward.

        We count on you to uphold the highest standards of professionalism and ethical conduct,
        contributing positively to our collective mission of advancing the ICT landscape in Uganda.

        We look forward to your contributions and the impact we will create together.

        Nkurunungi Gideon

        Chief Executive Officer
        ICT Association of Uganda
    </pre>
    @endif

    @if ($applicant->application_type == 'company')
        <pre>
Welcome to the ICT Association of Uganda (ICTAU). We are honored to have {{$applicant->company_name}}
as a Corporate Member for the year 2024. Your support plays a pivotal role in our
mission to foster a robust and innovative ICT sector in Uganda.

Corporate membership with ICTAU not only signifies your company's commitment to
technological advancement but also positions you as a key player in shaping the future of the
ICT ecosystem.  You now have unparalleled access to a network of professionals,
opportunities for industry collaboration, and platforms for showcasing your leadership in
tech-driven initiatives.

As part of our community, we encourage {{$applicant->company_name}} to actively engage in ICTAU
activities, share expertise, and collaborate on projects that drive sector growth.

We also emphasize the importance of ethical conduct and social responsibility in all
endeavors. As a corporate member, you lead by example, setting standards for integrity,
innovation, and impact in the ICT domain.

Once again, welcome to ICTAU.Your insights and contributions are invaluable to our collective success.

Nkurunungi Gideon

Chief Executive Officer
ICT Association of Uganda
        </pre>
    @endif
</div>
