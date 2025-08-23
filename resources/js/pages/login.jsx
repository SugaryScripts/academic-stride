import Navbar from "../layouts/Navbar";

export default function Home() {
    return (
        <div>
            <Navbar></Navbar>
            <div className="flex flex-col md:flex-row items-center justify-center min-h-screen">
                    <div className="flex-shrink-0 mb-8 md:mb-0 md:mr-16">
                        <img
                            src="/logo/iconbird.svg"
                            alt="Maskot burung merah melambai"
                            className="w-64 h-auto md:w-96"
                        />
                    </div>

                    <div className=" p-8 rounded-lg w-full max-w-sm">
                        <h1 className="text-3xl font-bold mb-6 ">Masuk</h1>

                        <div className="mb-4">
                            <label htmlFor="email" className="block text-gray-700 font-bold mb-2">
                                Alamat E-Mail
                            </label>
                            <input
                                type="email"
                                id="email"
                                placeholder="Tulis alamat e-mailmu"
                                className="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500"
                            />
                        </div>

                        <div className="mb-6">
                            <label htmlFor="password" className="block text-gray-700 font-bold mb-2">
                                Kata Sandi
                            </label>
                            <input
                                type="password"
                                id="password"
                                placeholder="Tulis kata sandimu"
                                className="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500"
                            />
                        </div>

                    <button className="w-full bg-primary text-white font-bold py-2 px-4 rounded-lg hover:bg-red-600 transition-colors duration-300">
                            Masuk
                    </button>
                </div>
            </div>
        </div>
    );

}
