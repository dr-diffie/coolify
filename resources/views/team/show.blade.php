<x-layout>
    <x-team.navbar :team="session('currentTeam')" />
    <h2>Members</h2>
    <div class="overflow-x-auto">
        <table class="table">
            <thead>
                <tr class="font-bold text-white uppercase border-coolgray-200">
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach (auth()->user()->currentTeam()->members->sortBy('name') as $member)
                    <livewire:team.member :member="$member" :wire:key="$member->id" />
                @endforeach
            </tbody>
        </table>
    </div>
    @if (auth()->user()->isAdmin())
        @if (!$transactional_emails_active)
            <div class="py-4">
                <h3 class="pb-4">Invite a new member</h3>
                <form class="flex items-center gap-2">
                    <x-forms.input type="email" name="email" placeholder="Email" />
                    <x-forms.button>Invite</x-forms.button>
                </form>
            </div>
        @else
            <div class="py-4">
                @if (!is_transactional_emails_active())
                    <h3>Invite a new member</h3>
                    <div class="pb-4 text-xs text-warning">You need to configure SMTP settings before you can invite a
                        new
                        member
                        via
                        email.
                    </div>
                @else
                    <h3 class="pb-4">Invite a new member</h3>
                @endif
                <livewire:team.invite-link />
            </div>


            <livewire:team.invitations :invitations="$invitations" />
        @endif
    @endif
</x-layout>
