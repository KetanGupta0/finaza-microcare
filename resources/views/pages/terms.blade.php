<x-layouts.site
    title="Terms of Use"
    description="Terms of use for the Finaza Microcare website."
    :crumbs="['Terms of Use' => route('terms')]"
>
    <x-page-hero eyebrow="Legal" title="Terms of Use" subtitle="Last updated: {{ now()->format('F Y') }}" :crumbs="['Terms of Use' => route('terms')]" />

    <section class="py-16 sm:py-24">
        <div class="container-x max-w-3xl prose-legal">
            <p>By using this website you agree to these terms. This website is operated by {{ config('site.company.legal_name') }} (CIN {{ config('site.company.cin') }}).</p>

            <h2>Information on this website</h2>
            <p>The content on this website is for general information only. It does not form an offer, approval or commitment of any financial product or service. Eligibility, documents, charges and terms are shared by our team on a case-by-case basis and in writing.</p>

            <h2>Enquiries</h2>
            <p>Submitting an enquiry does not guarantee any service. By submitting the form, you agree that we may contact you by phone, SMS or WhatsApp regarding your enquiry.</p>

            <h2>Acceptable use</h2>
            <ul>
                <li>Do not submit false information or information about another person without their consent.</li>
                <li>Do not attempt to disrupt, hack or misuse the website.</li>
            </ul>

            <h2>Intellectual property</h2>
            <p>The Finaza Microcare name, logo and website content belong to {{ config('site.company.legal_name') }} and may not be used without permission.</p>

            <h2>Limitation of liability</h2>
            <p>We try to keep the information accurate and up to date, but we are not liable for any loss arising from the use of this website or reliance on its content.</p>

            <h2>Governing law</h2>
            <p>These terms are governed by the laws of India, and courts at Patna, Bihar shall have jurisdiction.</p>

            <h2>Contact</h2>
            <p>For any questions, call {{ $contact['phoneDisplay'] }} or visit us at {{ config('site.address') }}.</p>
        </div>
    </section>
</x-layouts.site>
