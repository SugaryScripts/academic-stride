import { useForm } from '@inertiajs/react';
import { useState } from 'react';
import Navbar from "../layouts/Navbar";

export default function Home() {
    const { data, setData, post, processing, errors, reset } = useForm({
        username: '',
        password: '',
    });

    const [showPassword, setShowPassword] = useState(false);

    const handleSubmit = (e) => {
        e.preventDefault();

        post('/login', {
            onFinish: () => reset('password'), // Clear password on finish
            onError: () => {
                // Handle errors if needed
                console.log('Login failed');
            }
        });
    };

    return (
        <div>
            <Navbar />
            <div className="flex flex-col md:flex-row items-center justify-center min-h-screen">
                <div className="flex-shrink-0 mb-8 md:mb-0 md:mr-16">
                    <img
                        src="/logo/iconbird.svg"
                        alt="Maskot burung merah melambai"
                        className="w-64 h-auto md:w-96"
                    />
                </div>

                <div className="p-8 rounded-lg w-full max-w-sm">
                    <h1 className="text-3xl font-bold mb-6">Masuk</h1>

                    <form onSubmit={handleSubmit}>
                        <div className="mb-4">
                            <label htmlFor="username" className="block text-gray-700 font-bold mb-2">
                                NISN
                            </label>
                            <input
                                type="text"
                                id="username"
                                value={data.username}
                                onChange={(e) => setData('username', e.target.value)}
                                placeholder="Tulis NISN-mu"
                                className={`w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 ${
                                    errors.username ? 'border-red-500' : 'border-gray-300'
                                }`}
                                disabled={processing}
                                required
                            />
                            {errors.username && (
                                <p className="text-red-500 text-sm mt-1">{errors.username}</p>
                            )}
                        </div>

                        <div className="mb-6">
                            <label htmlFor="password" className="block text-gray-700 font-bold mb-2">
                                Kata Sandi
                            </label>
                            <div className="relative">
                                <input
                                    type={showPassword ? "text" : "password"}
                                    id="password"
                                    value={data.password}
                                    onChange={(e) => setData('password', e.target.value)}
                                    placeholder="Tulis kata sandimu"
                                    className={`w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 ${
                                        errors.password ? 'border-red-500' : 'border-gray-300'
                                    }`}
                                    disabled={processing}
                                    required
                                />
                                <button
                                    type="button"
                                    onClick={() => setShowPassword(!showPassword)}
                                    className="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-500 hover:text-gray-700"
                                    disabled={processing}
                                >
                                    {showPassword ? (
                                        <svg className="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L3 3m6.878 6.878L21 21" />
                                        </svg>
                                    ) : (
                                        <svg className="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                    )}
                                </button>
                            </div>
                            {errors.password && (
                                <p className="text-red-500 text-sm mt-1">{errors.password}</p>
                            )}
                        </div>

                        <button
                            type="submit"
                            disabled={processing}
                            className={`w-full font-bold py-2 px-4 rounded-lg transition-colors duration-300 ${
                                processing
                                    ? 'bg-gray-400 text-gray-200 cursor-not-allowed'
                                    : 'bg-red-500 text-white hover:bg-red-600'
                            }`}
                        >
                            {processing ? (
                                <div className="flex items-center justify-center">
                                    <svg className="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                        <circle className="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" strokeWidth="4"></circle>
                                        <path className="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                    </svg>
                                    Memproses...
                                </div>
                            ) : (
                                'Masuk'
                            )}
                        </button>
                    </form>

                    {/* Optional: Add forgot password link */}
                    <div className="mt-4 text-center">
                        <a
                            href="/forgot-password"
                            className="text-sm text-red-500 hover:text-red-600 transition-colors duration-300"
                        >
                            Lupa kata sandi?
                        </a>
                    </div>
                </div>
            </div>
        </div>
    );
}
