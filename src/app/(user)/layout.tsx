import "@/styles/globals.css";
import Navbar from "./(pages)/globalComponents/navbar/navbar";

export const metadata = {
  title: "CMS-SKLY",
  description: "Created using NextJS 13 + Tailwind CSS",
};

export default function RootLayout({
  children,
}: {
  children: React.ReactNode;
}) {
  return (
    <html lang="en">
      <body>
        <Navbar />
        {children}
      </body>
    </html>
  );
}
