<style>
    .nav-link {
        line-height: 1;
        margin-bottom: 10px;
    }
</style>
<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="/">Hmmm</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="/">Yaa</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="nav">
                <a href="{{ url('/') }}" class="nav-link" style="line-height: 1;"><i
                        class="fas fa-fire"></i><span>Dashboard</span></a>
                
            </li>
            <li class="nav">
                <a href="{{ url('/karyawan') }}" class="nav-link" style="line-height: 1;"><i
                        class="fas fa-fire"></i><span>Karyawan</span></a>
                
            </li>
            <li class="nav">
                <a href="{{ url('/penilaian') }}" class="nav-link" style="line-height: 1;"><i
                        class="fas fa-fire"></i><span>Penilaian</span></a>
                
            </li>

    </aside>
</div>
