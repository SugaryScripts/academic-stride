import MenuList from "./MenuList"

export default function SidebarBoost(){
    return(
    <nav className="pc-sidebar">
    <div className="navbar-wrapper ">
        <div className="m-header">
        <a href="/dashboard" className="b-brand text-primary">
            <img src="logo/Logo.png" className="img-fluid logo-lg" alt="logo" />
            <span className="badge bg-light-success rounded-pill ms-2 theme-version">v1.0.0</span>
        </a>
        </div>
        <div className="navbar-content border-1">
            <ul className="pc-navbar">
                <MenuList />
            </ul>
        </div>
    </div>
    </nav>
)}
