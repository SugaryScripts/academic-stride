export default function Footer(){
    return(
        <footer className="w-full mt-4 md:mt-8">
            <section className="bg-gray-100 py-6 md:py-8 lg:py-12">
                <div className="container mx-auto px-4 md:px-6">
                    <div className="flex flex-col gap-6 md:gap-8 items-center">
                        <h2 className="text-3xl md:text-5xl lg:text-6xl font-semibold text-gray-800 text-center leading-tight">
                            Mulai mendaftar.
                        </h2>
                        <button
                            variant="primary"
                            onClick={() => {}}
                            className="text-base font-medium px-8 py-3 bg-red-600 text-white rounded-md hover:bg-red-700"
                        >
                            Daftar
                        </button>
                    </div>
                </div>
            </section>

            {/* Main Footer Section */}
            <section className="bg-gray-900 text-white py-8 md:py-12 lg:py-16">
                <div className="container mx-auto px-4 md:px-6">
                    <div className="flex flex-col lg:flex-row justify-between items-start gap-8 lg:gap-16">
                        <div className="flex flex-col gap-6 md:gap-8 lg:gap-10 w-full lg:w-1/3">
                            <div className="flex items-center gap-2">
                                <img
                                    src="/logo/icon.png"
                                    alt="Logo"
                                    className="w-6 h-6"
                                />
                                <span className="font-bold text-sm text-gray-100">
                                    GARUDACERDAS
                                </span>
                            </div>

                            <div className="flex flex-col gap-1 text-sm text-gray-300">
                                <p>Copyright © 2025.</p>
                                <p>All rights reserved</p>
                            </div>

                            <div className="flex gap-4">
                                {/* <LinkedIn size={24} color="currentColor" /> */}
                            </div>
                        </div>

                        {/* Footer Links Section */}
                        <div className="flex flex-col sm:flex-row gap-8 lg:gap-16 w-full lg:w-2/3">
                            {/* About Us */}
                            <div className="flex flex-col gap-4 flex-1">
                                <h3 className="font-semibold text-lg text-white">
                                    Tentang Kami
                                </h3>
                                <div className="flex flex-col gap-2 text-sm text-gray-300">
                                    <p>Visi & Misi</p>
                                    <p>Tujuan dari TKA</p>
                                    <p>Karier</p>
                                </div>
                            </div>

                            {/* Help */}
                            <div className="flex flex-col gap-4 flex-1">
                                <h3 className="font-semibold text-lg text-white">
                                    Bantuan
                                </h3>
                                <div className="flex flex-col gap-2 text-sm text-gray-300">
                                    <p>Layanan Pengaduan</p>
                                    <p>Syarat & Ketentuan</p>
                                </div>
                            </div>

                            {/* Contact Us */}
                            <div className="flex flex-col gap-4 w-full flex-1">
                                <h3 className="font-semibold text-lg text-white">
                                    Hubungi Kami
                                </h3>
                                {/* <EditText
                                    placeholder="Alamat email..."
                                    className="text-sm bg-white/20 text-gray-200 placeholder-gray-400 rounded-md py-2 px-3"
                                /> */}
                            </div>

                        </div>
                    </div>
                </div>
            </section>
        </footer>
    )

}
