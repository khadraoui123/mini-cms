<x-layout>
    <x-slot:title>Utilisateurs - Mini-CMS</x-slot:title>

    <x-page-header
        title="Utilisateurs"
        subtitle="Un administrateur peut changer le rôle des autres comptes ou supprimer un compte : ses articles sont alors réassignés à un administrateur."
    />

    <div class="anim-scale-in overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead class="border-b border-gray-200 bg-gray-50 text-xs font-semibold uppercase tracking-wider text-gray-500">
                    <tr>
                        <th scope="col" class="px-6 py-3 font-semibold">Nom</th>
                        <th scope="col" class="px-6 py-3 font-semibold">E-mail</th>
                        <th scope="col" class="px-6 py-3 font-semibold">Rôle</th>
                        <th scope="col" class="px-6 py-3 text-right font-semibold">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse ($users as $user)
                        <tr class="transition-colors hover:bg-gray-50">
                            <td class="px-6 py-4 font-medium text-gray-900">{{ $user->name }}</td>
                            <td class="px-6 py-4 text-gray-600">{{ $user->email }}</td>
                            <td class="px-6 py-4">
                                <span class="rounded-full px-2.5 py-1 text-xs font-semibold {{ $user->isAdmin() ? 'bg-indigo-50 text-indigo-700' : 'bg-gray-100 text-gray-600' }}">{{ $user->role }}</span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex flex-wrap items-center justify-end gap-3">
                                    @if ($user->id === auth()->id())
                                        <span class="text-xs text-gray-500">Votre propre compte</span>
                                    @else
                                        <form method="POST" action="{{ route('admin.users.role', $user) }}" class="flex flex-wrap items-center gap-2">
                                            @csrf
                                            @method('PATCH')
                                            <label class="sr-only" for="role-{{ $user->id }}">Rôle de {{ $user->name }}</label>
                                            <select id="role-{{ $user->id }}" name="role" class="rounded-lg border border-gray-300 bg-white px-3 py-1.5 text-sm shadow-xs outline-none transition focus:border-indigo-400 focus:ring-3 focus:ring-indigo-100">
                                                <option value="author" @selected($user->role === 'author')>author</option>
                                                <option value="admin" @selected($user->role === 'admin')>admin</option>
                                            </select>
                                            <button type="submit" class="rounded-lg bg-indigo-600 px-3 py-1.5 text-sm font-medium text-white shadow-xs transition hover:bg-indigo-700">Enregistrer</button>
                                        </form>
                                        <form method="POST" action="{{ route('admin.users.destroy', $user) }}" onsubmit="return confirm('Supprimer cet utilisateur ? Ses articles seront réassignés à un administrateur.');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="rounded-lg bg-red-600 px-3 py-1.5 text-sm font-medium text-white shadow-xs transition hover:bg-red-700 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-600">Supprimer</button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-10 text-center text-gray-500">Aucun utilisateur.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-layout>
