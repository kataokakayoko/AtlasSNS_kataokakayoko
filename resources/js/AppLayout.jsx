import { useState } from 'react';
import { Link, useForm } from '@inertiajs/react';

export default function AppLayout({ children }) {
  const [isOpen, setIsOpen] = useState(false);
  const { post } = useForm();

  return (
    <div className="min-h-screen bg-gray-100">
      <header className="bg-gray-800 text-white p-4">
        <div className="max-w-7xl mx-auto">
          <div
            onClick={() => setIsOpen(!isOpen)}
            className="cursor-pointer flex justify-between items-center"
          >
            <span>メニュー</span>
            <span className={`transform transition-transform ${isOpen ? 'rotate-180' : ''}`}>▼</span>
          </div>
          {isOpen && (
            <ul className="bg-gray-700 mt-2 p-2 rounded">
              <li><Link href={route('top')} className="block p-2 hover:bg-gray-600">HOME</Link></li>
              <li><Link href={route('profile')} className="block p-2 hover:bg-gray-600">プロフィール編集</Link></li>
              <li>
                <button
                  onClick={() => post(route('logout'))}
                  className="w-full text-left p-2 hover:bg-gray-600"
                >
                  ログアウト
                </button>
              </li>
            </ul>
          )}
        </div>
      </header>
      <main className="p-4">{children}</main>
    </div>
  );
}
