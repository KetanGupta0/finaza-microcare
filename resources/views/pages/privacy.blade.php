<x-layouts.site
    title="Privacy Policy"
    description="How Finaza Microcare collects, uses and protects the personal information you share with us through our website, phone and WhatsApp."
    :crumbs="['Privacy Policy' => route('privacy')]"
>
    <x-page-hero eyebrow="Legal" title="Privacy Policy" subtitle="Last updated: {{ now()->format('F Y') }}" :crumbs="['Privacy Policy' => route('privacy')]" />

    <section class="py-16 sm:py-24">
        <div class="container-x max-w-3xl prose-legal">
            <p>{{ config('site.company.legal_name') }} ("Finaza Microcare", "we", "us") respects your privacy. This policy explains what information we collect through this website and how we use it.</p>

            <h2>Information we collect</h2>
            <ul>
                <li>Details you submit in our enquiry form: name, mobile number, email, city or village, the service you are interested in and your message.</li>
                <li>Basic technical information such as your IP address and browser type, used to keep the website secure and prevent spam.</li>
            </ul>

            <h2>How we use your information</h2>
            <ul>
                <li>To call, message or email you about your enquiry.</li>
                <li>To understand your needs and explain suitable options.</li>
                <li>To keep records of enquiries and improve our services.</li>
                <li>To protect our website from misuse.</li>
            </ul>

            <h2>Sharing of information</h2>
            <p>We do not sell or rent your personal information. We share it only with our authorised team members and service providers who help us operate, and when required by law or a government authority.</p>

            <h2>Data security</h2>
            <p>We use reasonable technical and organisational measures to protect your information. Access to enquiry data is limited to authorised staff with secure logins.</p>

            <h2>Your choices</h2>
            <p>You can ask us to update or delete your enquiry details, or to stop contacting you, by calling {{ $contact['phoneDisplay'] }}@if (config('site.email')) or writing to {{ config('site.email') }}@endif.</p>

            <h2>Fraud awareness</h2>
            <p>We will never ask for your OTP, ATM PIN, UPI PIN or passwords. If anyone asks for these in our name, please do not share them and inform us immediately.</p>

            <h2>Contact</h2>
            <p>{{ config('site.company.legal_name') }}, {{ config('site.address') }}. Phone: {{ $contact['phoneDisplay'] }}.</p>
        </div>
    </section>
</x-layouts.site>
