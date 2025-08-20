export default function MainLayout({ children }) {
  return (
    <>
        <div className="px-4 min-h-screen flex flex-col bg-gray-100 py-20">
            {children()}
        </div>
    </>
  );
}
