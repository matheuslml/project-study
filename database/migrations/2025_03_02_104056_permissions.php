<?php

use App\Models\AgreementOrigin;
use App\Models\AgreementSituation;
use App\Models\BiddingSituation;
use App\Models\DocumentType;
use App\Models\FileType;
use App\Models\Genre;
use App\Models\LegislationAuthor;
use App\Models\MatrialStatus;
use App\Models\NotificationStatus;
use App\Models\NotificationType;
use App\Models\PermissionInformation;
use App\Models\TypeMedia;
use App\Models\TypePost;
use App\Models\TypeRequest;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Migrations\Migration;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Hash;

class Permissions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     * @throws Exception
     */
    public function up(): void
    {

        // Transparência
        Role::findByName('Desenvolvedor')->permissions()->firstOrCreate(['name' => 'Ver e Listar Sobre', 'guard_name' => 'web']);
        Role::findByName('Desenvolvedor')->permissions()->firstOrCreate(['name' => 'Criar Sobre', 'guard_name' => 'web']);
        Role::findByName('Desenvolvedor')->permissions()->firstOrCreate(['name' => 'Editar Sobre', 'guard_name' => 'web']);
        Role::findByName('Desenvolvedor')->permissions()->firstOrCreate(['name' => 'Deletar Sobre', 'guard_name' => 'web']);

        Role::findByName('Desenvolvedor')->permissions()->firstOrCreate(['name' => 'Ver e Listar Contratações Diretas', 'guard_name' => 'web']);
        Role::findByName('Desenvolvedor')->permissions()->firstOrCreate(['name' => 'Criar Contratações Diretas', 'guard_name' => 'web']);
        Role::findByName('Desenvolvedor')->permissions()->firstOrCreate(['name' => 'Editar Contratações Diretas', 'guard_name' => 'web']);
        Role::findByName('Desenvolvedor')->permissions()->firstOrCreate(['name' => 'Deletar Contratações Diretas', 'guard_name' => 'web']);

        Role::findByName('Desenvolvedor')->permissions()->firstOrCreate(['name' => 'Ver e Listar Galeria', 'guard_name' => 'web']);
        Role::findByName('Desenvolvedor')->permissions()->firstOrCreate(['name' => 'Criar Galeria', 'guard_name' => 'web']);
        Role::findByName('Desenvolvedor')->permissions()->firstOrCreate(['name' => 'Editar Galeria', 'guard_name' => 'web']);
        Role::findByName('Desenvolvedor')->permissions()->firstOrCreate(['name' => 'Deletar Galeria', 'guard_name' => 'web']);

        Role::findByName('Desenvolvedor')->permissions()->firstOrCreate(['name' => 'Ver e Listar Galeria', 'guard_name' => 'web']);
        Role::findByName('Desenvolvedor')->permissions()->firstOrCreate(['name' => 'Criar Galeria', 'guard_name' => 'web']);
        Role::findByName('Desenvolvedor')->permissions()->firstOrCreate(['name' => 'Editar Galeria', 'guard_name' => 'web']);
        Role::findByName('Desenvolvedor')->permissions()->firstOrCreate(['name' => 'Deletar Galeria', 'guard_name' => 'web']);

        Role::findByName('Desenvolvedor')->permissions()->firstOrCreate(['name' => 'Ver e Listar Liderança', 'guard_name' => 'web']);
        Role::findByName('Desenvolvedor')->permissions()->firstOrCreate(['name' => 'Criar Liderança', 'guard_name' => 'web']);
        Role::findByName('Desenvolvedor')->permissions()->firstOrCreate(['name' => 'Editar Liderança', 'guard_name' => 'web']);
        Role::findByName('Desenvolvedor')->permissions()->firstOrCreate(['name' => 'Deletar Liderança', 'guard_name' => 'web']);

        Role::findByName('Desenvolvedor')->permissions()->firstOrCreate(['name' => 'Ver e Listar Projetos', 'guard_name' => 'web']);
        Role::findByName('Desenvolvedor')->permissions()->firstOrCreate(['name' => 'Criar Projetos', 'guard_name' => 'web']);
        Role::findByName('Desenvolvedor')->permissions()->firstOrCreate(['name' => 'Editar Projetos', 'guard_name' => 'web']);
        Role::findByName('Desenvolvedor')->permissions()->firstOrCreate(['name' => 'Deletar Projetos', 'guard_name' => 'web']);

    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
    }
}
