import AccountSubHeader from "@/components/shared/AccountSubHeader/AccountSubHeader";
import { useRouter } from "next/navigation";
import React from "react";

const TermsAndConditions = () => {
  return (
    <div>
      <AccountSubHeader title="Terms & Conditions" enableBackPress />
      <div className="min-w-full max-w-[900px] px-6 md:px-10 lg:px-[150px] ms-5 max-878:ms-0 mt-4 mb-[100px] text-white">
        <section className="space-y-8">
          <div className="space-y-2">
            <h2 className="text-2xl font-semibold">1. Introduction</h2>
            <p>
              Welcome to 27 Circle! By using our platform, you agree to these Terms and Conditions. If you do not agree, please do not use the
              service.
            </p>
          </div>

          <div className="space-y-2">
            <h2 className="text-2xl font-semibold">2. User Responsibilities</h2>

            <h3 className="text-lg font-semibold">For Guests:</h3>
            <ul className="list-disc pl-5">
              <li>You must provide accurate personal information when signing up.</li>
              <li>If you book a Circle, you must attend or cancel at least 1 hour before the location is revealed (25 hours before the event).</li>
              <li>No-shows will affect your reliability score, which experienced Hosts may consider when allowing guests to join.</li>
            </ul>

            <h3 className="text-lg font-semibold">For Hosts:</h3>
            <ul className="list-disc pl-5">
              <li>Hosts must ensure their event happens as planned.</li>
              <li>Hosts cannot charge guests outside the platform.</li>
              <li>Location changes are allowed up to 2 hours before the event start time; guests should check for updates.</li>
            </ul>

            <h3 className="text-lg font-semibold">General Conduct:</h3>
            <ul className="list-disc pl-5">
              <li>All users must act respectfully.</li>
              <li>Harassment, discrimination, and illegal activities are strictly prohibited.</li>
              <li>Users can report inappropriate behavior or safety concerns through the platform.</li>
            </ul>
          </div>

          <div className="space-y-2">
            <h2 className="text-2xl font-semibold">3. Payments & Refunds</h2>
            <ul className="list-disc pl-5">
              <li>All payments are processed through 27 Circle's payment system. External payments are not allowed.</li>
              <li>
                Hosts must set up a direct deposit account to receive earnings. If no account is registered, earnings will be forfeited, as 27 Circle
                does not hold balances or offer credit.
              </li>
              <li>Ticket prices are determined by the Host.</li>
            </ul>

            <h3 className="text-lg font-semibold">Refunds:</h3>
            <ul className="list-disc pl-5">
              <li>Guests can cancel up to 1 hour before the location is revealed and receive a refund.</li>
              <li>If an event is canceled by the Host or 27 Circle, guests will receive a full refund.</li>
              <li>If an event is overbooked, excess attendees will be refunded automatically.</li>
              <li>No refunds are issued for last-minute guest cancellations or no-shows.</li>
            </ul>
          </div>

          <div className="space-y-2">
            <h2 className="text-2xl font-semibold">4. Liability Disclaimer</h2>
            <ul className="list-disc pl-5">
              <li>27 Circle only facilitates connections between users. We do not oversee or verify events.</li>
              <li>Users attend events at their own risk. 27 Circle is not responsible for personal safety, property damage, or disputes.</li>
              <li>Users should exercise personal judgment before attending any event.</li>
            </ul>
          </div>

          <div className="space-y-2">
            <h2 className="text-2xl font-semibold">5. Account Suspension</h2>
            <ul className="list-disc pl-5">
              <li>27 Circle reserves the right to suspend or remove any user who violates these terms.</li>
              <li>
                Suspensions may result from:
                <ul className="list-disc pl-5">
                  <li>Repeated no-shows.</li>
                  <li>Reports of inappropriate behavior.</li>
                  <li>Attempts to charge outside the platform.</li>
                  <li>Any actions that harm the platform’s integrity.</li>
                </ul>
              </li>
            </ul>
          </div>

          <div className="space-y-2">
            <h2 className="text-2xl font-semibold">6. Dispute Resolution</h2>
            <ul className="list-disc pl-5">
              <li>Any issues, disputes, or complaints should be reported to info@27circle.co.</li>
              <li>27 Circle will review cases on a case-by-case basis, but decisions are final.</li>
            </ul>
          </div>
        </section>
      </div>{" "}
    </div>
  );
};

export default TermsAndConditions;
