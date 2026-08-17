/* Nexus Admin Panel — Profile page */

function apAvatarPick(input) {
    var file = input.files && input.files[0];
    var name = document.getElementById('apAvatarName');
    var preview = document.getElementById('apAvatarPreview');

    if (!file) {
        name.textContent = 'Belum ada foto';
        return;
    }

    name.textContent = file.name + ' (' + Math.round(file.size / 1024) + ' KB)';
    preview.src = URL.createObjectURL(file);
    preview.classList.remove('hidden');
}

function apPwEye(id) {
    var el = document.getElementById(id);
    el.type = el.type === 'password' ? 'text' : 'password';
}

function apPwMeter(v) {
    var score = 0;
    if (v.length >= 10) score++;
    if (/[A-Z]/.test(v) && /[a-z]/.test(v)) score++;
    if (/[0-9]/.test(v)) score++;
    if (/[^A-Za-z0-9]/.test(v)) score++;
    if (!v.length) score = 0;

    var tones = ['bg-muted', 'bg-red-500', 'bg-amber-500', 'bg-sky-500', 'bg-emerald-500'];
    var labels = ['kosong', 'lemah', 'sedang', 'baik', 'kuat'];

    document.querySelectorAll('#apPwMeterBars span').forEach(function (bar, i) {
        bar.className = 'h-1 flex-1 rounded-full ' + (i < score ? tones[score] : 'bg-muted');
    });
    document.getElementById('apPwMeterLabel').textContent = labels[score];
}
