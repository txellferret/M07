
    <?php
     
     use Illuminate\Database\Seeder;
     use Illuminate\Database\Eloquent\Model;
      
     class DatabaseSeeder extends Seeder
     {
         /**
          * Run the database seeds.
          *
          * @return void
          */
         public function run()
         {
         //creem 20 registres de Item amb 5 Note per a cada un.
             factory(App\Item::class, 20)->create()->each(function ($item) {
                 for ($i=0;$i<5;$i++) {
                     $item->addNote(factory(App\Note::class)->make());
                 }
             });        
         }
     }
 
 

//No funciona