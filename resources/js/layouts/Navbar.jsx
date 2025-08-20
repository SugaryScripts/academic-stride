import { Link } from "@inertiajs/react";

export default function Navbar({ isLoggedIn }) {
    return (
        <nav className="bg-gray-100 p-4 flex justify-between items-center shadow-md">

            <div className="flex items-center">
                <img
                    src="/logo/Icon.svg"
                    alt="Garuda Cerdas Logo"
                    className="mr-2 h-8 w-8"
                />
                <span className="font-bold text-lg text-gray-800">GARUDACERDAS</span>
            </div>

            {isLoggedIn && (
                <div className="hidden md:flex space-x-8 font-medium text-gray-600">
                    <Link href="/" className="hover:text-red-500 transition-colors duration-300">
                        Beranda
                    </Link>
                    <Link href="/" className="hover:text-red-500 transition-colors duration-300">
                        Program
                    </Link>
                    <Link href="/" className="hover:text-red-500 transition-colors duration-300">
                        Event
                    </Link>
                    <Link href="/" className="hover:text-red-500 transition-colors duration-300">
                        Testimoni
                    </Link>
                    <Link href="/" className="hover:text-red-500 transition-colors duration-300">
                        FAQ
                    </Link>
                    <Link href="/" className="hover:text-red-500 transition-colors duration-300">
                        Profil
                    </Link>
                </div>
            )}

            <div className="flex items-center gap-4">
                {isLoggedIn ? (

                    <Link href="/profil" className="bg-red-600 text-white font-bold py-2 px-6 rounded-md hover:bg-red-700 transition-colors duration-300">
                        Profil
                    </Link>
                ) : (

                    <>
                        <Link href="/login" className="text-red-600 font-bold hover:underline">
                            Login
                        </Link>
                        <Link href="/register" className="bg-red-600 text-white font-bold py-2 px-6 rounded-md hover:bg-red-700 transition-colors duration-300">
                            Daftar
                        </Link>
                    </>
                )}
            </div>
        </nav>
    );
}
