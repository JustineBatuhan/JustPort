@extends('layouts.admin')

@section('title', 'Skills')
@section('page-title', '🛠️ Skills')
@section('topbar-actions')
    <a href="{{ route('admin.skills.create') }}" class="btn btn-primary btn-sm">➕ Add Skill</a>
@endsection

@section('content')
<div class="card">
    <table>
        <thead>
            <tr>
                <th style="width: 250px;">Name</th>
                <th style="width: 150px;">Category</th>
                <th>Proficiency Level</th>
                <th style="width: 80px;">Sort</th>
                <th style="width: 150px;">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($skills as $skill)
            <tr data-skill-id="{{ $skill->id }}">
                <td><strong>{{ $skill->name }}</strong></td>
                <td>
                    @if($skill->category === 'Frontend') <span class="badge badge-cyan">🎨 Frontend</span>
                    @elseif($skill->category === 'Backend') <span class="badge badge-purple">⚙️ Backend</span>
                    @else <span class="badge badge-green">🛠️ Tools</span>
                    @endif
                </td>
                <td>
                    <div class="slider-container">
                        <input type="range" 
                               class="skill-level-slider" 
                               min="0" max="100" 
                               value="{{ $skill->level }}" 
                               data-url="{{ route('admin.skills.update-level', $skill) }}">
                        <div class="level-badge">
                            <span class="level-value">{{ $skill->level }}</span>%
                        </div>
                        <div class="save-status"></div>
                    </div>
                </td>
                <td style="color:var(--text-muted)">{{ $skill->sort_order }}</td>
                <td>
                    <div class="actions">
                        <a href="{{ route('admin.skills.edit', $skill) }}" class="btn btn-outline btn-sm">✏️</a>
                        <form action="{{ route('admin.skills.destroy', $skill) }}" method="POST" onsubmit="return confirm('Delete this skill?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">🗑️</button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr><td colspan="5" style="text-align:center;color:var(--text-muted);padding:2rem">No skills yet.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const sliders = document.querySelectorAll('.skill-level-slider');
    
    sliders.forEach(slider => {
        const row = slider.closest('tr');
        const valueDisplay = row.querySelector('.level-value');
        const statusIcon = row.querySelector('.save-status');
        let timeout = null;

        slider.addEventListener('input', function() {
            // Update display only
            valueDisplay.textContent = this.value;
            statusIcon.classList.remove('saved', 'error');
            statusIcon.textContent = '';
        });

        slider.addEventListener('change', function() {
            const newLevel = this.value;
            const url = this.dataset.url;

            // Visual feedback - Saving
            statusIcon.textContent = '⏳';
            
            fetch(url, {
                method: 'PATCH',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ level: newLevel })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    statusIcon.textContent = '✅';
                    statusIcon.classList.add('saved');
                    // Add a tiny glow to the row
                    row.classList.add('row-saved-glow');
                    setTimeout(() => row.classList.remove('row-saved-glow'), 1000);
                } else {
                    statusIcon.textContent = '❌';
                    statusIcon.classList.add('error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                statusIcon.textContent = '❌';
                statusIcon.classList.add('error');
            });
        });
    });
});
</script>
@endpush
@endsection
