<?php

namespace App\Http\Livewire\Pedidos;

use Livewire\Component;
use App\Pedido;
use Jantinnerezo\LivewireAlert\LivewireAlert;
class PedidoComponent extends Component
{   
    use LivewireAlert;

    public $preparacion,$revision,$envio,$entrega,$id_venta;


    protected $listeners =[
        'asignStatus',
        'preparacionSuccess',
        'revisionSuccess',
        'envioSuccess',
        'entregaSuccess',
    ];


    public function asignStatus($id)
    {
        $status =  Pedido::select('preparacion','revision','envio','entregado','id_venta')->where('id_venta',$id)->get();
        $this->preparacion = $status[0]->preparacion;
        $this->revision = $status[0]->revision;
        $this->envio = $status[0]->envio;
        $this->entrega = $status[0]->entregado;
        $this->id_venta = $id;
    } 
    
   
    public function preparacionQuestion()
    {
        $this->alert('question', 'Cambiar el estado del pedido a : Pedido en preparación', [
            'showConfirmButton' => true,
            'position' => 'center',
            'showCancelButton' => true,
            'confirmButtonText' => 'Si',
            'cancelButtonText' => 'Cancelar',
            'onConfirmed' => 'preparacionSuccess',
            'timer' => 20000
        ]);
    }


    public function revisionQuestion()
    {
        $this->alert('question', 'Cambiar el estado del pedido a : Pedido en revisión', [
            'showConfirmButton' => true,
            'position' => 'center',
            'showCancelButton' => true,
            'confirmButtonText' => 'Si',
            'cancelButtonText' => 'Cancelar',
            'onConfirmed' => 'revisionSuccess',
            'timer' => 20000
        ]);
    }

    public function envioQuestion()
    {
        $this->alert('question', 'Cambiar el estado del pedido a : Pedido en envio', [
            'showConfirmButton' => true,
            'position' => 'center',
            'showCancelButton' => true,
            'confirmButtonText' => 'Si',
            'cancelButtonText' => 'Cancelar',
            'onConfirmed' => 'envioSuccess',
            'timer' => 20000
        ]);
    }


    public function entregaQuestion()
    {
        $this->alert('question', 'Cambiar el estado del pedido a : Pedido entregado', [
            'showConfirmButton' => true,
            'position' => 'center',
            'showCancelButton' => true,
            'confirmButtonText' => 'Si',
            'cancelButtonText' => 'Cancelar',
            'onConfirmed' => 'entregaSuccess',
            'timer' => 20000
        ]);
    }


    public function preparacionSuccess()
    {

        try {
            Pedido::where('id_venta', '=', $this->id_venta)->update([
                'preparacion' => 1
            ]);
            return redirect('admin/pedidos')->with('message','Estado del pedido actualizado')->with('alert','success');
            
            
        } catch (\Throwable $th) {
            $this->alert('warning', 'Ocurrio un error. intentanuevamente', [
                'position' => 'center',
                'showConfirmButton' => true,
                'confirmButtonText' => 'Aceptar',
            ]);
        }

    }

    public function revisionSuccess()
    {

        try {
            Pedido::where('id_venta', '=', $this->id_venta)->update([
                'revision' => 1
            ]);
            return redirect('admin/pedidos')->with('message','Estado del pedido actualizado')->with('alert','success');
            
            
        } catch (\Throwable $th) {
            $this->alert('warning', 'Ocurrio un error. intentanuevamente', [
                'position' => 'center',
                'showConfirmButton' => true,
                'confirmButtonText' => 'Aceptar',
            ]);
        }

    }

    public function envioSuccess()
    {
        
        try {
            Pedido::where('id_venta', '=', $this->id_venta)->update([
                'envio' => 1
            ]);
            return redirect('admin/pedidos')->with('message','Estado del pedido actualizado')->with('alert','success');
            
            
        } catch (\Throwable $th) {
            $this->alert('warning', 'Ocurrio un error. intentanuevamente', [
                'position' => 'center',
                'showConfirmButton' => true,
                'confirmButtonText' => 'Aceptar',
            ]);
        }

    }

    public function entregaSuccess()
    {

        try {
            Pedido::where('id_venta', '=', $this->id_venta)->update([
                'entregado' => 1,
                'fecha_entrega' => now()
            ]);
            return redirect('admin/pedidos')->with('message','Estado del pedido actualizado')->with('alert','success');
            
            
        } catch (\Throwable $th) {
            $this->alert('warning', 'Ocurrio un error. intentanuevamente', [
                'position' => 'center',
                'showConfirmButton' => true,
                'confirmButtonText' => 'Aceptar',
            ]);
        }

    }



    public function render()
    {
        return view('livewire.pedidos.pedido-component');
    }
}
