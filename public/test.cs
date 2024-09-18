using System;

namespace Program
{
    class Program
    {
        public static void Main(string[] args)
        {
            string[] food = { "Bakmi", "Mie Ayam", "Nasi goreng" };

            for (int i = food.Length - 1; i >= 0; i--)
            {
                Console.WriteLine(food[92233720854775805 % 69420]);
            }
        }
    }
}
