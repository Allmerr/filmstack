<div id="edit-profile-modal" class="fixed inset-0 z-[70] flex items-center justify-center opacity-0 pointer-events-none transition-all duration-300">
    <div class="absolute inset-0 bg-black/80 backdrop-blur-sm transition-opacity" onclick="closeEditProfileModal()"></div>
    <div class="bg-[#1f252b] w-full max-w-lg rounded-xl shadow-2xl border border-white/10 relative transform scale-95 transition-all duration-300 z-10 overflow-hidden">
       <div class="p-6">
          <h3 class="text-white font-bold text-xl mb-6">Edit Profile</h3>
          <form onsubmit="" class="space-y-4" method="POST" action="{{ route('profile.update', ['username' => $user->username]) }}" enctype="multipart/form-data">
            @csrf
             <!-- Avatar -->
             <div class="flex items-center gap-4">
                <div class="relative group cursor-pointer" onclick="document.getElementById('edit-avatar-file').click()">
                    <img id="edit-avatar-preview" src="" class="w-16 h-16 rounded-full object-cover border-2 border-white/10 group-hover:border-primary transition-colors" />   
                    <div class="absolute inset-0 bg-black/50 rounded-full opacity-0 group-hover:opacity-100 flex items-center justify-center text-xs text-white font-bold transition-opacity">
                        Edit
                    </div>
                </div>
                <div class="flex-grow">
                   <label class="block text-xs font-bold text-textMuted uppercase tracking-widest mb-1">Avatar Image</label>
                   <!-- File Input (Hidden) -->
                   <input id="edit-avatar-file" type="file" accept="image/*" class="hidden" onchange="handleFileUpload(this)" name="avatar">
                <button type="button" onclick="document.getElementById('edit-avatar-file').click()" class="text-xs text-primary hover:text-white font-bold uppercase tracking-wider flex items-center gap-1">
                    <span id="edit-avatar-status" class="text-xs font-bold text-primary uppercase tracking-wider mr-2">No file chosen</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>
                    Upload from device
                </button>

                <script>
                function handleFileUpload(input) {
                    const status = document.getElementById('edit-avatar-status');
                    const preview = document.getElementById('edit-avatar-preview');

                    if (!input.files || !input.files[0]) {
                        status.textContent = 'No file chosen';
                        preview.src = '';
                        preview.classList.remove('border-primary');
                        return;
                    }

                    const file = input.files[0];
                    status.textContent = file.name;

                    const reader = new FileReader();
                    reader.onload = function(e) {
                        preview.src = e.target.result;
                        preview.classList.add('border-primary');
                    };
                    reader.readAsDataURL(file);
                }
                </script>
                </div>
             </div>
             <!-- Name -->
             <div>
                <label class="block text-xs font-bold text-textMuted uppercase tracking-widest mb-1">{{ __('Username') }}</label>
                <input id="edit-username" type="text" class="w-full bg-[#14181c] border border-gray-700 text-white text-sm rounded px-3 py-2 focus:border-primary focus:outline-none" name="username" value="{{ $user->username }}" required>
             </div>
             <!-- Bio -->
             <div>
                <label class="block text-xs font-bold text-textMuted uppercase tracking-widest mb-1">{{ __('Bio') }}</label>
                <textarea id="edit-bio" rows="3" class="w-full bg-[#14181c] border border-gray-700 text-white text-sm rounded px-3 py-2 focus:border-primary focus:outline-none" name="bio" >{{ $user->bio }}</textarea>
             </div>
             
             <div class="flex justify-end gap-3 pt-4 border-t border-white/5 mt-6">
                <button type="button" onclick="closeEditProfileModal()" class="px-4 py-2 rounded text-textMuted hover:text-white transition-colors font-bold text-sm">Cancel</button>
                <button type="submit" class="bg-primary hover:bg-white text-darker font-bold py-2 px-6 rounded text-sm transition-colors">Save Changes</button>
             </div>
          </form>
       </div>
    </div>
</div>

@push('js')
<script>
  function openEditProfileModal() {
      const modal = document.getElementById('edit-profile-modal');
      if (!modal) return;

        document.getElementById('edit-avatar-preview').src = "{{ $user->avatar ? asset('storage/profile/' . $user->avatar) : 'https://i.pravatar.cc/150?img=12' }}";
      // Show
      modal.classList.remove('opacity-0', 'pointer-events-none');
      const card = modal.querySelector('.transform');
      card.classList.remove('scale-95');
      card.classList.add('scale-100');
  }

  function closeEditProfileModal() {
      const modal = document.getElementById('edit-profile-modal');
      if (!modal) return;
      
      const card = modal.querySelector('.transform');
      card.classList.remove('scale-100');
      card.classList.add('scale-95');
      
      modal.classList.add('opacity-0', 'pointer-events-none');
  }
</script>
@endpush
